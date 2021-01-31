<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Repositories\Accounts;
use App\Models\Account;

use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

class AuthController extends Controller
{

    /**
     * Show login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Post login information to authenticate
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $credentials = [
            'login_id' => $request->get('login_id'),
            'password' => $request->get('password')
        ];
        try {
            $accounts = new Accounts();
            $isMaster = $accounts->isMaster($credentials['login_id'], 1);
            if ($isMaster ) {
                Sentinel::disableCheckpoints();
            }
            else if (!$isMaster && $accounts->isLock($credentials['login_id']) ) {
                Sentinel::disableCheckpoints();
                return redirect()->back()->with(['error' => "あなたは禁止されていました。管理者に連絡してお願いします。"]);
            } else {
                if (Sentinel::authenticate($credentials)) {
                    return redirect()->intended('/');
                } else {
                    // Wrong credentials
                    return redirect()->back()->with(['error' => 'アカウント・パスワードが正しくありません。']);
                }
            }
        } catch (ThrottlingException $e) {
            // You are banned for $delay seconds.
            $delay = $e->getDelay();
            Account::where('login_id', isset($_POST['login_id']) ? $_POST['login_id'] : '')->update(['lock' => 1]);
            return redirect()->back()->with(['error' => "あなたは禁止されていました。管理者に連絡してお願いします。"]);
            //return redirect()->back()->with(['error' => "あなたは $delay 秒間禁止されています。"]);
        } catch (NotActivatedException $e) {
            // Your account is not activated.
            return redirect()->back()->with(['error' => "お客様のアカウントは有効化されていません。"]);
        }
    }

    /**
     * Do logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Sentinel::logout();
        return redirect()->route('login');
    }
}
