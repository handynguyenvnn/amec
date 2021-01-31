<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Repositories\Tags;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Tags $tag
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Tags $tag, Request $request)
    {
        $keyword = $request->input("keyword");
        if ( $keyword != "" ) {
            $data = $tag->search($keyword);
        } else {
            $data = $tag->getAll();
        }
        return view('tag.list', compact('data','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tags $tag)
    {
        $tag->create($request->all());
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @param Tags $tags
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Tags $tags)
    {
        $tags->delete($id);
        return redirect()->route('tags.index');
    }

    /**
     * @param Tag $tag
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function checkUse(Tags $tag, Request $request)
    {
        $id = $request->input("id");
        if ($tag->checkID($id)){
            return response('yes', 200);
        } else {
            return response('no', 200);
        }
    }
}
