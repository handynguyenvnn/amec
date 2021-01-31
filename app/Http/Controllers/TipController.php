<?php

namespace App\Http\Controllers;

use App\Repositories\Chapters;
use Illuminate\Http\Request;
use App\Repositories\Tips;
use App\Repositories\Languages;
use App\Repositories\Versions;
use Illuminate\Support\Facades\Session;
use App\Repositories\Collections;
use App\Repositories\Projects;

/**
 * This class manage all function of Tips
 * Class TipController
 * @package App\Http\Controllers
 */
class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Tips $tips
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Tips $tips, Languages $languages, Request $request)
    {
        $data = $tips->search($request->all());
        $lang = $languages->getAll();

        $params = $request->except('current_id');
        return view('tip.list', compact('data', 'lang', 'params'));
    }

    /**
     * This function create data
     *
     * @param Tips $tips
     * @param Versions $versions
     * @param Collections $collections
     * @param Projects $projects
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( Tips $tips, Versions $versions, Collections $collections, Projects $projects)
    {
        $optionCollection = $collections->getAll();
        $optionVersion = $versions->getAll();
        $optionProject = $projects->getAll();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $tips->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('tip.create', compact( 'params', 'optionVersion', 'optionCollection', 'optionProject'));
    }

    /**
     * This function store data
     * @param Request $request
     * @param Tips $tips
     * @param Chapters $chapters
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Tips $tips, Chapters $chapters)
    {
        $tips->createTips($request->except('_token'), $chapters);
        return redirect()->route('tips.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * This function edit data
     *
     * @param Tips $tips
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Tips $tips)
    {
        $data = $tips->getById($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $tips->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('tip.edit', compact('data', 'languages', 'areas', 'params'));
    }

    /**
     * This function update data
     *
     * @param Request $request
     * @param $id
     * @param Tips $tips
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request, Tips $tips)
    {
        $data = $request->except('_token', '_method');
        $tips->update($id, $data);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $tips->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return redirect(route('tips.index', $params));
    }

    /**
     * This function destroy data
     *
     * @param Tips $tips
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tips $tips, $id)
    {
        $tips->delete($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $tips->action) {
            $params = Session::get('params');
            $params['current_id'] = $id-1;
        }
        return redirect(route('tips.index', $params));
    }
}
