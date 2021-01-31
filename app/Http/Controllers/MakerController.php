<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use Illuminate\Http\Request;
use App\Repositories\Makers;
use App\Http\Requests\MakerRequest;


class MakerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Makers $maker
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Makers $maker, Request $request)
    {
        $keyword = $request->input("keyword");
        if ( $keyword != "" ) {
            $data = $maker->search($keyword);
        } else {
            $data = $maker->getAll();
        }
        return view('maker.list', compact('data','keyword'));
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
    public function store(Request $request)
    {
        $input = $request->all();
        if(isset($input['name']) && ($input['name']!= '')){
            $makers = new Maker();
            $makers->name = $input['name'];
            $makers->save();
        }
        return redirect()->route('makers.index');
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
     * @param Makers $makers
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Makers $makers)
    {
        $makers->delete($id);
        return redirect()->route('makers.index');
    }

    /**
     * @param Makers $makers
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function checkUse(Makers $makers, Request $request)
    {
        $id = $request->input("id");
        if ($makers->checkID($id)){
            return response('yes', 200);
        } else {
            return response('no', 200);
        }
    }
}
