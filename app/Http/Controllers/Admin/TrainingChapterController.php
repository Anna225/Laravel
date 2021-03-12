<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TrainingChapter;

class TrainingChapterController extends Controller
{
    /**
     * Display a listing of the Training Chapters.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapters = TrainingChapter::orderBy('order')->get();
        return view('admin.chapters.index', compact('chapters'));
    }

    /**
     * Show the form for creating a new chapter.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.chapters.create');
    }

    /**
     * Store a newly created chapter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'description'    => 'required',
            'quiz_questions' => 'required|integer',
            'min_pass_marks' => 'required|integer',
            'study_time'     => 'required|integer',
            'image'          => 'required|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $data = $request->all();
        // Convert passed minutes to second value
        $data['study_time'] = $request->study_time * 60;
        // get the order of last item on database
        $lastChapterEntry  = TrainingChapter::get()->last();
        $chapterOrder = ( $lastChapterEntry ) ? $lastChapterEntry->order + 1 : 0;
        
        $data['order'] = $chapterOrder;
        
        $chapter = TrainingChapter::create($data);

        if ( $request->hasFile('image') ) {
            $chapter_image = 'chapter-'.time().'.'.$request->file('image')->extension();
            $request->image->storeAs('images', $chapter_image,'public');
            $chapter->image = $chapter_image;
            $chapter->save();
        }

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.chapters.index')->with('success','Chapter Successfully Added');
        } else {
            return redirect()->route('admin.chapters.create')->with('success','Chapter Successfully Added');
        }
    }

    /**
     * Display the specified chapter.
     *
     * @param  \App\TrainingChapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingChapter $chapter)
    {
        return view('admin.chapters.show', compact('chapter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrainingChapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(TrainingChapter $chapter)
    {
        return view('admin.chapters.edit', compact('chapter'));
    }

    /**
     * Update the specified chapter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrainingChapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrainingChapter $chapter)
    {
        $request->validate([
            'name'           => 'required',
            'description'    => 'required',
            'quiz_questions' => 'required|integer',
            'min_pass_marks' => 'required|integer',
            'study_time'     => 'required|integer',
            'image'          => 'sometimes|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        $data = $request->all();
        // Convert passed minutes to second value
        $study_time         = $request->study_time * 60;
        $data['study_time'] = $study_time;

        $chapter->update($data);

        if ( $request->hasFile('image') ) {
            $chapter_image = 'chapter-'.time().'.'.$request->file('image')->extension();
            $request->image->storeAs('images', $chapter_image,'public');
            $chapter->image = $chapter_image;
        }

        if ( $chapter->save() ) {
            return redirect()->route('admin.chapters.index')->with('success', 'Training Chapter Updated');
        } else {
            return redirect()->route('admin.chapters.edit', $chapter->id)->with('error', 'Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrainingChapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingChapter $chapter)
    {
        if ( $chapter->delete() ) {
            return back()->with('success', 'Training Chapter Deleted');
        } else {
            return back()->with('error', 'Something went wrong');
        }
        
    }

    /**
     * Update the order of chapters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateChapterOrder(Request $request){
        if($request->ajax()){
            $updatedChapter = $request->chapter;

            foreach ($updatedChapter as $key => $chapter) {
                TrainingChapter::where('id', $chapter)->update(['order' => $key ]);
            }

            return Response(['success'=>'Order Updated','order'=> $updatedChapter]);
        }
    }
}
