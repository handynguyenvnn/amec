<?php

namespace App\Http\Controllers;

use App\Repositories\Masters;
use Illuminate\Http\Request;
use App\Repositories\Advertisements;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of Grades
 * Class GradeController
 * @package App\Http\Controllers
 */
class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Masters $masters
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( Masters $masters, Request $request)
    {
        $data = $masters->search($request->all());
        $params = $request->except('current_id');
        return view('master.list', compact('data', 'params'));
    }

    /**
     * This function create data
     *
     * @param Masters $masters
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( Masters $masters)
    {
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $masters->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('master.create', compact( 'params'));
    }

    /**
     * This function store data
     *
     * @param Request $request
     * @param Masters $masters
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Masters $masters)
    {
        $masters->create($request->except('_token'));
        return redirect()->route('master.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param  Masters $masters
     * @return \Illuminate\Http\Response
     */
    public function info($id, Masters $masters)
    {
        $masters = $masters->getById($id);
        return response()->json($masters);
    }

    /**
     * This function update data
     *
     * @param Request $request
     * @param $id
     * @param Masters $masters
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request, Masters $masters)
    {
        $data = $request->except('_token', '_method');
        $masters->update($id, $data);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $masters->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return redirect(route('master.index', $params));
    }

    /**
     * This function destroy data
     *
     * @param Masters $masters
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Masters $masters)
    {
        $masters->delete($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $masters->action) {
            $params = Session::get('params');
            $params['current_id'] = $id-1;
        }
        return redirect(route('master.index', $params));
    }
}
