<?php

namespace App\Http\Controllers;

use App\Libs\Constants\Constant;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Repositories\Announcements;
use App\Repositories\Languages;
use App\Repositories\Areas;
use App\Http\Requests\AnnouncementRequest;
use Illuminate\Support\Facades\Session;

/**
 * This class manage all function of Announcement
 * Class AnnouncementController
 * @package App\Http\Controllers
 */
class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Announcements $announcement
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Announcements $announcement, Request $request)
    {
        $data = $announcement->search($request->all());
        $params = $request->except('current_id');
        return view('announcement.list', compact('data', 'params'));
    }

    /**
     * This function create data
     *
     * @param Languages $languages
     * @param Areas $areas
     * @param Announcements $announcements
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Languages $languages, Areas $areas, Announcements $announcements)
    {
        $languages = $languages->getAll();
        $areas = $areas->getAll();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $announcements->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('announcement.create', compact('languages', 'areas', 'params'));
    }

    /**
     * This function store data
     *
     * @param AnnouncementRequest $request
     * @param Announcements $announcements
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AnnouncementRequest $request, Announcements $announcements)
    {
        $announcements->create($request->except('_token'));
        return redirect()->route('announcements.index');
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
     * @param Announcements $announcements
     * @param $id
     * @param Languages $languages
     * @param Areas $areas
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Announcements $announcements, Languages $languages, Areas $areas)
    {
        $data = $announcements->getById($id);
        $languages = $languages->getAll();
        $areas = $areas->getAll();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $announcements->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('announcement.edit', compact('data', 'languages', 'areas', 'params'));
    }

    public function action($id=null, Announcements $announcements, Languages $languages)
    {
        $languages = $languages->getAll();
        $data = $announcements->getById($id);
        if($data){
            $areas = Area::where('language_id', $data->language_id)->get();
        }else {
            $areas = Area::where('language_id', Constant::LANG_JA_ID)->get();
        }
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $announcements->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('announcement.action', compact('data', 'languages', 'areas', 'params'));
    }

    /**
     * This function update data
     *
     * @param AnnouncementRequest $request
     * @param $id
     * @param Announcements $announcements
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, AnnouncementRequest $request, Announcements $announcements)
    {
        $data = $request->except('_token', '_method');
        $announcements->update($id, $data);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $announcements->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return redirect(route('announcements.index', $params));
    }

    /**
     * This function destroy data
     *
     * @param Announcements $announcements
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Announcements $announcements, $id)
    {
        $announcements->delete($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $announcements->action) {
            $params = Session::get('params');
            $params['current_id'] = $id-1;
        }
        return redirect(route('announcements.index', $params));
    }
    public function area($language_id){
        $areas = Area::where('language_id',$language_id)->get();
        foreach ($areas as $area){
            echo '<option value="'.$area->id.'">'.$area->area.'</option>';
        }

    }
}
