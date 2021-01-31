<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;
use App\Repositories\MessagesSmallTests;
use App\Repositories\MessagesBigTests;
use App\Repositories\MessagesTips;
use App\Repositories\Languages;
use App\Repositories\Versions;

class MessageController extends Controller
{
    public function store(Request $request, MessagesSmallTests $messagesSmallTests , MessagesBigTests $messagesBigTests,
                          MessagesTips $messagesTips, Languages $languages, Versions $versions)
    {
        $languages = $languages->getAll();
        $req = $request->except('_token');
        $versionId = $req['versionId'];

        if ($req['category_message'] == Constant::CATEGORY_MESSAGE_SMALL_TEST_CODE) {
            $messagesSmallTests->save($req, $languages);
        }
        if ($req['category_message'] == Constant::CATEGORY_MESSAGE_BIG_TEST_CODE){
            $messagesBigTests->save($req, $languages);
        }
        if($req['category_message'] == Constant::CATEGORY_MESSAGE_TIPS_CODE){
            $messagesTips->save($req, $languages);
        }

        return redirect(route('chapters.list', [$request['gradeId'], $versionId]));
    }


    public function index(){

    }
}
