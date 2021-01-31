<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Advertisements;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of Grades
 * Class GradeController
 * @package App\Http\Controllers
 */
class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Advertisements $advertisements
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Advertisements $advertisements, Request $request)
    {
        $data = $advertisements->search($request->all());
        $params = $request->except('current_id');
        $onOff= Constant::ON_OFF;
        return view('advertisement.list', compact('data','onOff', 'params'));
    }

    /**
     * This function create data
     *
     * @param Advertisements $advertisements
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( Advertisements $advertisements)
    {
        $onOff= Constant::ON_OFF;
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $advertisements->action) {
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
     * @param Advertisements $advertisements
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Advertisements $advertisements)
    {
        $id = null;
        $data = $request->except('_token', '_method');
        $advertisements->updateAds($id, $data);
        return redirect(route('advertisements.action'));
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
     * @param Advertisements $advertisements
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Advertisements $advertisements)
    {
        $data = $advertisements->getAdvertisementById($id);
        $onOff = Constant::ON_OFF;
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $advertisements->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('advertisement.edit', compact('data','onOff', 'params'));
    }
    public function action(Advertisements $advertisements)
    {
        $data = $advertisements->getAdvertisementFirst();
        $onOff = Constant::ON_OFF;
        $path_media  = Constant::S3_URL . DS . Constant::S3_BUCKET_URL . DS;
        return view('advertisement.action', compact('data','path_media', 'onOff'));
    }

    /**
     * This function update data
     *
     * @param Request $request
     * @param $id
     * @param Advertisements $advertisements
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request, Advertisements $advertisements)
    {
        $data = $request->except('_token', '_method');
        $advertisements->updateAds($id, $data);
        return redirect(route('advertisements.action'));
    }
    public function delete($id, Advertisements $advertisements)
    {
        $advertisements->deleteAds($id);
        return redirect(route('advertisements.action'));
    }

    /**
     * This function destroy data
     *
     * @param Advertisements $advertisements
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Advertisements $advertisements)
    {
        $advertisements->delete($id);
        $advertisements->deleteVersionByGradeId($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $advertisements->action) {
            $params = Session::get('params');
            $params['current_id'] = $id-1;
        }
        return redirect(route('advertisements.index', $params));
    }
}
