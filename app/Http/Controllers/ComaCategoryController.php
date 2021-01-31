<?php

namespace App\Http\Controllers;

use App\Models\ComaCategory;
use App\Models\Language;
use App\Repositories\ComaCategories;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\Announcements;
use App\Http\Requests\AnnouncementRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

/**
 * This class manage all function of ComaCategory
 * Class ComaCategoryController
 * @package App\Http\Controllers
 */
class ComaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ComaCategories $comaCategories
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ComaCategories $comaCategories, Request $request)
    {
        $data = $comaCategories->search($request->all());
        $params = $request->except('current_id');
        $languages = Language::all();
        return view('coma_category.list', compact('data', 'params', 'languages'));
    }

    public function getByNo($no, ComaCategories $comaCategories){
        $comaCategories = $comaCategories->getByNo($no);
        return response()->json($comaCategories);
    }

    /**
     * This function store data.
     * @param Request $request
     * @param ComaCategories $comaCategories
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, ComaCategories $comaCategories)
    {
        $comaCategories->createComaCategory($request->except('_token'));
        return redirect()->route('coma-categories.index');
    }

    /**
     * This function update data.
     * @param $id
     * @param Request $request
     * @param ComaCategories $comaCategories
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, ComaCategories $comaCategories)
    {
        $data = $request->except('_token', '_method');
        $comaCategories->update($id, $data);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $comaCategories->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return redirect(route('coma-categories.index', $params));
    }

    /**
     * @param $no
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($no)
    {
        ComaCategory::where('coma_category_no', $no)->delete();
        return redirect(route('coma-categories.index'));
    }
}
