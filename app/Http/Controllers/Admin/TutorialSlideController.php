<?php

namespace App\Http\Controllers\Admin;

use App\TutorialSlide;
use App\TrainingChapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TutorialSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $chapter = TrainingChapter::with(['slides'=> function ($query){
            $query->orderBy('order');
        }])->findOrFail($id);

        return view('admin.slides.index', compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.slides.create', ['chapter_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        $content        = $this->dataDbReady($request->content);

        // get the order of last item on database
        $lastEntry  = TutorialSlide::where('training_chapter_id', (int)$request->chapter_id)->get()->last();
        $slideOrder = ( $lastEntry ) ? $lastEntry->order + 1 : 0;

        $tutorialSlide  = TutorialSlide::create([
            'training_chapter_id' => (int)$request->chapter_id,
            'title'              => $request->title,
            'content'            => $content,
            'order'              => $slideOrder
        ]);

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.slides.index',$request->chapter_id)->with('success','Slide Successfully Added');
        } else {
            return redirect()->route('admin.slides.create', $request->chapter_id)->with('success','Slide Successfully Added');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TutorialSlide $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = TutorialSlide::findOrFail($id);
        return view('admin.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrainingChapter $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);
        $tutorialSlide          = TutorialSlide::findOrfail($id);
        $tutorialSlide->title   = $request->title;
        $tutorialSlide->content = $request->content;

        if ( $tutorialSlide->save() ) {
            return redirect()->route('admin.slides.index',$request->chapter_id)->with('success', 'Slide has been Updated');
        } else {
            return redirect()->route('admin.slides.edit',$id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TutorialSlide  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slideToDelete = TutorialSlide::findOrFail($id);

        if( $slideToDelete->delete() ){   
            return back()->with('success', 'Slide Deleted');
        } else {
            return back()->with('error', 'Something went wrong.');
        }
        
    }

    /**
     * Upload images from CKeditor 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editorImageUpload(Request $request)
    {
        $CKEditor = $request->input('CKEditor');
        $funcNum  = $request->input('CKEditorFuncNum');
        $message  = $url = '';

        if ( $request->hasFile('upload') ) {
            $file = $request->file('upload');
            if ($file->isValid()) {
                $filename = 'slide-'.time().'.'.$request->file('upload')->extension();
                $request->upload->storeAs('images', $filename,'public');
                $url      = asset('storage/images/'.$filename);                
            } else {
                $message = 'An error occurred while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }

    /**
     * Make CKEditor content to ready for storing in DB
     * 
     * @param $content  
     */
    public function dataDbReady($content)
    {
        $content = trim($content);
        $content = stripslashes($content);
        $content = htmlspecialchars($content);
        return $content;
    }

    /**
     * Update the order of chapters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSlideOrder(Request $request){
        if($request->ajax()){
            $updatedSlides = $request->slide;

            foreach ($updatedSlides as $key => $slide) {
                TutorialSlide::where('id', $slide)->update(['order' => $key ]);
            }

            return Response(['success'=>'Order Updated','order'=> $updatedSlides]);
        }
    }
}
