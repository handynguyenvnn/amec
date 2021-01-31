<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserTransmissionHistories;
use App\Repositories\Languages;
use App\Repositories\Areas;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;
use App\Libs\S3\S3Upload;
use App\Models\User;

/**
 * Class UserHistoryController
 * @package App\Http\Controllers
 */
class UserHistoryController extends Controller
{
    /**
     * @param UserTransmissionHistories $userTransmissionHistories
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chapters(UserTransmissionHistories $userTransmissionHistories, Request $request, $uid)
    {
        $params = $request->except('current_id');
        $params['isChapter'] = 1;
        $fullname = User::find($uid)->username;
        $data = $userTransmissionHistories->filterChapters($uid, $request->all());
        return view('user_history.chapter', compact('data', 'params', 'uid', 'fullname'));
    }

    /**
     * @param UserTransmissionHistories $userTransmissionHistories
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bigTests(UserTransmissionHistories $userTransmissionHistories, Request $request, $uid)
    {
        $params = $request->except('current_id');
        $params['isBigTests'] = 1;
        $fullname = User::find($uid)->username;
        $data = $userTransmissionHistories->filterBigtests($uid, $request->all());
        return view('user_history.big_test', compact('data', 'params', 'uid', 'fullname'));
    }
    public function appTimes(UserTransmissionHistories $userTransmissionHistories, Request $request, $uid)
    {
        $params = $request->except('current_id');
        $params['isAppTimes'] = 1;

        $fullname = User::find($uid)->username;
        $data = $userTransmissionHistories->findAppTimes($uid, $request->all());
        return view('user_history.app_time', compact('data', 'params', 'uid', 'fullname'));
    }
    /**
     * @param Languages $languages
     * @param Areas $areas
     * @param UserTransmissionHistories $userTransmissionHistories
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Languages $languages, Areas $areas, UserTransmissionHistories $userTransmissionHistories)
    {
        $languages = $languages->getAll();
        $areas = $areas->getAll();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $userTransmissionHistories->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('user_history.create', compact('languages', 'areas', 'params'));
    }

    /**
     * @param Request $request
     * @param UserTransmissionHistories $userTransmissionHistories
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, UserTransmissionHistories $userTransmissionHistories)
    {
        $test = S3Upload::upload($request,'image', Constant::S3_CATEGORY_IMAGE);
        $userTransmissionHistories->create($request->except('_token'));
        return redirect()->route('user-histories.index');
    }

    /**
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @param UserTransmissionHistories $userTransmissionHistories
     * @param Languages $languages
     * @param Areas $areas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, UserTransmissionHistories $userTransmissionHistories, Languages $languages, Areas $areas)
    {
        $data = $userTransmissionHistories->getById($id);
        $languages = $languages->getAll();
        $areas = $areas->getAll();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $userTransmissionHistories->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('user_history.edit', compact('data', 'languages', 'areas', 'params'));
    }

    /**
     * @param $id
     * @param Request $request
     * @param UserTransmissionHistories $userTransmissionHistories
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, UserTransmissionHistories $userTransmissionHistories)
    {
        $data = $request->except('_token', '_method');
        $userTransmissionHistories->update($id, $data);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $userTransmissionHistories->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return redirect(route('user-histories.index', $params));
    }

    /**
     * @param UserTransmissionHistories $userTransmissionHistories
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy( UserTransmissionHistories $userTransmissionHistories, $id)
    {
        $userTransmissionHistories->delete($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $userTransmissionHistories->action) {
            $params = Session::get('params');
            $params['current_id'] = $id-1;
        }
        return redirect(route('user-histories.index', $params));
    }
}
