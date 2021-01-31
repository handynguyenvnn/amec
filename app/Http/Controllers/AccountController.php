<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Repositories\Accounts;
use App\Repositories\Authorities;
use App\Repositories\PossessionAuthorities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Sentinel;

class AccountController extends Controller
{
    /**
     * Show list screen
     *
     * @param Accounts $accounts
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Accounts $accounts, Request $request)
    {
        $data = $accounts->search($request->all());
        $params = $request->except('current_id');
        return view('account.list', compact('data', 'params'));
    }

    /**
     * Show create screen
     *
     * @param Accounts $accounts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Accounts $accounts)
    {
        // Get all the roles
        $roles = Sentinel::getRoleRepository()->get();

        // set params to back
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $accounts->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('account.create', compact('roles', 'params'));
    }

    /**
     * Create new account
     *
     * @param Accounts $accounts
     * @param AccountRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Accounts $accounts, AccountRequest $request)
    {
        $accounts->create($request->only('name', 'login_id', 'password', 'roles', 'lock'));
        return redirect(route('accounts.index'));
    }

    /**
     * Show edit account screen
     *
     * @param $id
     * @param Accounts $accounts
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Accounts $accounts)
    {
//        echo 'asdasd';exit;
        if ($accounts->isMaster($id)) return redirect(route('accounts.index'));

        $account = Sentinel::findById($id);

        // Get all the roles
        $roles = Sentinel::getRoleRepository()->get();

        // set params to back
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $accounts->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('account.edit', compact('account', 'roles', 'params'));
    }

    /**
     * Update account
     *
     * @param $id
     * @param Request $request
     * @param Accounts $accounts
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, Accounts $accounts)
    {
        if ($accounts->isMaster($id)) return redirect(route('accounts.index'));
        $password = $request->get('password');
        $updateArr = array('name', 'password', 'roles', 'lock');
        if (strlen($password) == 0) {
            unset($updateArr['password']);
        }
        $accounts->update($id, $request->only($updateArr));
        return redirect(route('accounts.index'));
    }

    /**
     * Delete account
     *
     * @param $id
     * @param Accounts $accounts
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id, Accounts $accounts)
    {
        $accounts->delete($id);
        return redirect(route('accounts.index'));
    }
}
