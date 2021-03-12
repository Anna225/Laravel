<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created page in storage.
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

        //Create slug
        $slug = $this->createSlug($request->title);

        $page = Page::create([
            'title'   => $request->title,
            'slug'    => $slug,
            'content' => $request->content
        ]);

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.pages.index')->with('success','Page Successfully Created');
        } else {
            return redirect()->route('admin.pages.create')->with('success','Page Successfully Created');
        }
    }

    /**
     * Display the specified page.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('pages'));
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified page in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title'    => 'required',
            'slug'     => 'required',  
            'content'  => 'required',
        ]);

        $page->title   = $request->title;
        $page->content = $request->content;

        if ($page->slug != $request->slug) {
            $page->slug = $this->createSlug($request->slug, $page->id);
        }

        if ( $page->save() ) {
            return redirect()->route('admin.pages.index')->with('success','Page Updated');   
        } else {
            return redirect()->route('admin.pages.index')->with('error','Something went wrong');
        }
    }

    /**
     * Remove the specified page from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if( $page->delete() ){
            return back()->with('success', 'Page Deleted');
        } else {
            return back()->with('error', 'Page went wrong');
        }
    }

    /**
     * @param $title
     * @param int $id
     * @return string
     * @throws \Exception
     */
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title, '-');

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public function getRelatedSlugs($slug, $id = 0)
    {
        return Page::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    /**
     * Load the page content from slug 
     */
    public function loadContent($slug)
    {
        $page = Page::whereSlug($slug)
                     ->whereStatus('1')
                     ->firstOrfail();

        $content = html_entity_decode($page->content);

        return view('page', compact('page', 'content'));
    }
}
