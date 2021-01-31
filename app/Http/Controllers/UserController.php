<?php

namespace App\Http\Controllers;

use App\Libs\Constants\Constant;
use App\Models\User;
use App\Repositories\Areas;
use App\Repositories\Professions;
use Illuminate\Http\Request;
use App\Repositories\Users;
use App\Repositories\Languages;
use App\Http\Requests\UserRequest;
use App\Models\Area;
use App\Models\Profession;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Libs\ApiValidators\UserValidator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
//use Ven

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Users $users
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Users $users,  Request $request)
    {
        $data = $users->search($request->all());
        $params = $request->except('current_id');
//        $request = $request->except('_token','_method');
        return view('user.list', compact('data', 'params'));
    }
    public function import(Users $users,  Request $request)
    {
        if ($request->file('userfile')) {
            $file = file_get_contents($request->file('userfile'));
            $datas = chr(255).chr(254).mb_convert_encoding($file, "UTF-8", "UTF-16LE");
            $datas = array_map("str_getcsv", preg_split('/\r*\n+|\r+/', $datas));
            if (count($datas) > 0) {
                array_shift($datas);
                array_pop($datas);
                foreach ($datas as $key => $data) {
                    if(count($data)>0) {
                        $arrayData = explode("\t", $data[0]);
                        $this->saveData($arrayData);
                    }
                }
            }
            $errors = "インポートに成功したファイル。";
            return redirect()->route('users.index')->with('messages', $errors);
        }else {
            $errors = 'このEXCELのファイルのコンテンツファイルを間違っています。 再チェックしてお願いします。';
            return redirect()->route('users.index')->with('messages', $errors);
        }
    }
    public function saveData($data = array()){

        if (isset($data[1]) && $data[1] != '') {

            if (isset($data[0]) && is_numeric($data[0])) {
                $user_add = User::find($data[0]);
                if (!(count($user_add) > 0)) {
                    $user_add = new User();
                    if ((isset($data[0]) && is_numeric($data[0]))) {
                        $user_add->id = $data[0];
                        $user_add->password = password_hash('123456', PASSWORD_BCRYPT);
                        $user_add->email = $data[1];
                        $user_add->language_id = (isset($data[2]) && ($data[2] != '')) ? $data[2] : 1;
                        $user_add->username = isset($data[3]) ? $data[3] : '';
                        $user_add->gender = (isset($data[4]) && ($data[4] != '')) ? $data[4] : 1;
                        $user_add->area_id = (isset($data[5]) && ($data[5] != '')) ? $data[5] : 1;
                        $user_add->profession_id = (isset($data[6]) && ($data[6] != '')) ? $data[6] : 1;
                        $user_add->phone = isset($data[7]) ? $data[7] : '';
                        $user_add->registration_date = date('Y-m-d h:i:s');
                        if (!(User::where('email', '=', $user_add->email)->exists())) {
                            $user_add->save();
                        }
                    }
                }else{
                    $user_add->language_id = (isset($data[2]) && ($data[2] != '')) ? $data[2] : 1;
                    $user_add->username = isset($data[3]) ? $data[3] : '';
                    $user_add->gender = (isset($data[4]) && ($data[4] != '')) ? $data[4] : 1;
                    $user_add->area_id = (isset($data[5]) && ($data[5] != '')) ? $data[5] : 1;
                    $user_add->profession_id = (isset($data[6]) && ($data[6] != '')) ? $data[6] : 1;
                    $user_add->phone = isset($data[7]) ? $data[7] : '';
                    $user_add->registration_date = date('Y-m-d h:i:s');
                    if($user_add->email != $data[1]){
                        if (!(User::where('email', '=', $user_add->email)->exists())) {
                            $user_add->save();
                        }
                    }else {
                        $user_add->save();
                    }
                }
            } else {
                $user_add = new User();
                $user_add->password = password_hash('123456', PASSWORD_BCRYPT);
                $user_add->email = $data[1];
                $user_add->language_id = (isset($data[2]) && ($data[2] != '')) ? $data[2] : 1;
                $user_add->username = isset($data[3]) ? $data[3] : '';
                $user_add->gender = (isset($data[4]) && ($data[4] != '')) ? $data[4] : 1;
                $user_add->area_id = (isset($data[5]) && ($data[5] != '')) ? $data[5] : 1;
                $user_add->profession_id = (isset($data[6]) && ($data[6] != '')) ? $data[6] : 1;
                $user_add->phone = isset($data[7]) ? $data[7] : '';
                $user_add->registration_date = date('Y-m-d h:i:s');
                if (!(User::where('email', '=', $user_add->email)->exists())) {
                    $user_add->save();
                }
            }
        }
    }

    /**
     * @param Languages $languages
     * @param Areas $areas
     * @param Professions $professions
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( Languages $languages, Areas $areas, Professions $professions)
    {
        $lang = $languages->getAll();
        $areas = $areas->getAll();
        $professions = $professions->getAll();
        return view('user.create', compact('languages', 'areas', 'professions', 'lang'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @param Users $users
     * @param Languages $languages
     * @param Areas $areas
     * @param Professions $professions
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Users $users, Languages $languages, Areas $areas, Professions $professions)
    {
        $data = $users->getUserByID($id);
        $lang = $languages->getAll();
        $areas = $areas->getAll();
        $professions = $professions->getAll();
        return view('user.edit', compact('data','lang', 'areas', 'professions'));
    }

    public function action($id=null, Users $users, Languages $languages, Areas $areas, Professions $professions)
    {
        $data = $users->getUserByID($id);
        $lang = $languages->getAll();
        $areas = Area::where('language_id', Constant::LANG_JA_ID)->get();
        $professions = Profession::where('language_id', Constant::LANG_JA_ID)->get();
        $loginDate = $users->getLastLogin($id);
        return view('user.action', compact('data','lang', 'areas', 'professions', 'loginDate'));
    }


    /**
     * @param Request $request
     * @param $id
     * @param Users $users
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id=null, Users $users)
    {
        $data = $request->except('_token','_method');
        if($id) {
            $currentEmail = $users->getUserByID($id)->email;
            if ($currentEmail != $data['email']) {
                $this->validate($request,
                    array(
                        'email' => 'required|email|unique:users,email',
                    ),
                    array(
                        'email.required' => 'あなたはメールアドレスを入力していません',
                        'email.email' => '電子メールを送信する。',
                        'email.unique' => 'メールでのお問い合わせ。'
                    )
                );
            }
        }
        $users->updateUser($id, $data, $request);
        return redirect()->route('users.index');
    }
    /**
     * @param Request $request
     * @param Users $users
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, Users $users)
    {
        $data = $request->except('_token','_method');
        $this->validate($request,
            array(
                'email' => 'required|email|unique:users,email',
            ),
            array(
                'email.required' => 'あなたはメールアドレスを入力していません',
                'email.email' => '電子メールを送信する。',
                'email.unique' => 'メールでのお問い合わせ。'
            )
        );
        $id = null;
        $users->updateUser($id, $data, $request);
        return redirect(route('users.index'));
    }
    public function deleteImage($id){
        $user = User::find($id);
        if(count($user)>0) {
            $user->user_photo = '';
            $user->save();
        }
        return redirect()->route('users.action', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Users $users)
    {
        $users->delete($id);
        return redirect()->route('users.index');
    }
    public function download( Users $users)
    {
        $file = 'users_'.date("d_m_Y_H_i_s").'.xls';
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
        header("Content-Description: File Transfer");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-type: application/vnd.ms-excel; charset=UTF16-LE");
        header("Content-Disposition: attachment; filename=$file; charset=UTF16-LE");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Content-Transfer-Encoding: binary");
        $users  = $users->getAll();
        $results = 'id'."\t".'email'."\t"."langguage_id"."\t"."username"."\t"."gender"."\t"."area_id"."\t"."profession_id"."\t"."phone"."\t\n";
        foreach ($users as $key => $user){
            $results .=  $user->id."\t";
            $results .=  $user->email."\t";
            $results .=  $user->language_id."\t";
            $results .=  $user->username."\t";
            $results .=  $user->gender."\t";
            $results .=  $user->area_id."\t";
            $results .=  $user->profession_id."\t";
            $results .=  $user->phone."\t\n";
        }
        print_r (chr(255).chr(254).mb_convert_encoding($results, "UTF-16LE", "UTF-8"));die;


    }
    public function area($language_id){
        $areas = Area::where('language_id',$language_id)->get();
        foreach ($areas as $area){
            echo '<option value="'.$area->id.'">'.$area->area.'</option>';
        }

    }
    public function profession($language_id){
        $professions = Profession::where('language_id',$language_id)->get();
        foreach ($professions as $profession){
            echo '<option value="'.$profession->id.'">'.$profession->profession.'</option>';
        }

    }
    public function importUserExcel(){
        return view('user.import');
    }

}
