<?php

namespace App\Http\Controllers;

use App\Models\BigTest;
use App\Repositories\BigTests;
use App\Repositories\SmallTests;
use App\Repositories\Versions;
use Illuminate\Http\Request;
use App\Repositories\Contents;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;
use App\Repositories\Grades;
use App\Repositories\Languages;
use Sentinel;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Contents $contents
     * @param Versions $versions
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Contents $contents, Versions $versions, SmallTests $smallTests, Request $request)
    {
        $data = $contents->search($request->all());
        $params = $request->except('current_id');
        return view('content.list', compact('data', 'params'));
    }
    public function sortable(Request $request, Contents $contents, $_table = null, $_field = null, $_where = "")
    {
        $contents->sortable($request->except('_token'), $_table, $_field, $_where);
        exit(1);
    }
    public function save(Request $request, Grades $grades, Languages $languages) {
        $_r = $request->except('_token', '_method');
        $data = [
            'content_type'  => 1,
            'id'            => $_r['id'],
            'grade_no'      => intval(DB::table('grades')->max('grade_no')) + 1,
            'ja_name'       => $_r['name']
        ];
        $data['user_id'] = Sentinel::getUser()->id;
        $id = $grades->createGrade($data, $languages->getAll());
        //Create new big test
        $big_tests = new BigTest();
        $big_tests->grade_id = $id;
        $big_tests->save();
        print_r($data); die;
    }
    /**
     * This function create data
     *
     * @param Contents $contents
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( Contents $contents)
    {
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $contents->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('advertisement.create', compact( 'params','onOff'));
    }

    /**
     * This function store data
     *
     * @param Request $request
     * @param Contents $contents
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Contents $contents)
    {
        $contents->createGrade($request->except('_token'));
        return redirect()->route('advertisements.index');
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
     * @param Contents $contents
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Contents $contents)
    {
        $data = $contents->getAdvertisementById($id);
        $onOff = Constant::ON_OFF;
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $contents->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('advertisement.edit', compact('data','onOff', 'params'));
    }

    /**
     * This function update data
     *
     * @param Request $request
     * @param $id
     * @param Contents $contents
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request, Contents $contents)
    {
        $data = $request->except('_token', '_method');
        $contents->update($id, $data);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $contents->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return redirect(route('advertisements.index', $params));
    }

    /**
     * This function destroy data
     *
     * @param Contents $contents
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Contents $contents)
    {
        $contents->delete($id);
        $contents->deleteVersionByGradeId($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $contents->action) {
            $params = Session::get('params');
            $params['current_id'] = $id-1;
        }
        return redirect(route('advertisements.index', $params));
    }
}
