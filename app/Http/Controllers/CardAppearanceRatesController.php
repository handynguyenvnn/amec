<?php

namespace App\Http\Controllers;

use App\Repositories\Collections;
use App\Repositories\Levels;
use App\Repositories\Users;
use Illuminate\Http\Request;
use App\Repositories\CardAppearanceRates;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of Grades
 * Class GradeController
 * @package App\Http\Controllers
 */
class CardAppearanceRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param CardAppearanceRates $cardAppearanceRates
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(CardAppearanceRates $cardAppearanceRates, Request $request)
    {
        $data = $cardAppearanceRates->search($request->all());
        $params = $request->except('current_id');
        return view('card_appearance_rates.list', compact('data', 'params'));
    }

    /**
     * This function create data
     * @param CardAppearanceRates $cardAppearanceRates
     * @param Collections $collections
     * @param Users $users
     * @param Levels $levels
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( CardAppearanceRates $cardAppearanceRates, Collections $collections, Users $users, Levels $levels)
    {
        $collections = $collections->getAll();
        $users = $users->getAll();
        $levels = $levels->getAll();
        $onOff = Constant::ON_OFF;
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $cardAppearanceRates->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('card_appearance_rates.create', compact( 'collections', 'users', 'levels', 'onOff', 'params'));
    }

    /**
     * This function store data
     *
     * @param Request $request
     * @param CardAppearanceRates $cardAppearanceRates
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, CardAppearanceRates $cardAppearanceRates)
    {
        $cardAppearanceRates->create($request->except('_token'));
        return redirect()->route('card-appearance-rates.index');
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
     * @param $id
     * @param CardAppearanceRates $cardAppearanceRates
     * @param Collections $collections
     * @param Users $users
     * @param Levels $levels
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, CardAppearanceRates $cardAppearanceRates, Collections $collections, Users $users, Levels $levels)
    {
        $data = $cardAppearanceRates->getById($id);
        $collections = $collections->getAll();
        $users = $users->getAll();
        $levels = $levels->getAll();
        $onOff = Constant::ON_OFF;
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $cardAppearanceRates->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('card_appearance_rates.edit', compact('data', 'collections', 'users', 'levels', 'onOff', 'params'));
    }

    /**
     * This function update data
     * @param $id
     * @param Request $request
     * @param CardAppearanceRates $cardAppearanceRates
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, CardAppearanceRates $cardAppearanceRates)
    {
        $data = $request->except('_token', '_method');
        $cardAppearanceRates->update($id, $data);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $cardAppearanceRates->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return redirect(route('card-appearance-rates.index', $params));
    }

    /**
     * This function destroy data
     * @param $id
     * @param CardAppearanceRates $cardAppearanceRates
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id, CardAppearanceRates $cardAppearanceRates)
    {
        $cardAppearanceRates->delete($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $cardAppearanceRates->action) {
            $params = Session::get('params');
            $params['current_id'] = $id-1;
        }
        return redirect(route('card-appearance-rates.index', $params));
    }
}
