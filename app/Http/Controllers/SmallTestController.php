<?php

namespace App\Http\Controllers;

use App\Models\Coma;
use App\Models\SmallTestQuestion;
use App\Repositories\SmallTests;
use App\Repositories\Chapters;
use App\Repositories\Xmls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;
use App\Repositories\MessagesSmallTests;
use App\Repositories\Collections;
use App\Repositories\Versions;
use App\Repositories\Comas;
use App\Repositories\ComaCategories;
use App\Repositories\Languages;

class SmallTestController extends Controller
{
    /**
     * @param SmallTests $smallTests
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(SmallTests $smallTests, Request $request)
    {
        $data = $smallTests->search($request->all());
        $params = $request->except('current_id');
        return view('small_test.list', compact('data', 'params'));
    }


    /**
     * @param SmallTests $smallTests
     * @param Collections $collections
     * @param Versions $versions
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(SmallTests $smallTests, Collections $collections, Versions $versions)
    {
        $optionCollection = $collections->getAll();
        $optionVersion = $versions->getAll();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $smallTests->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('chapter.create', compact('params', 'optionCollection', 'optionVersion'));
    }

    /**
     * @param Request $request
     * @param Chapters $chapters
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Chapters $chapters)
    {
        $chapters->createChapter($request->except('_token'));
        return redirect()->route('chapters.index');
    }

    /**
     * @param $id
     * @param SmallTests $smallTests
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, SmallTests $smallTests, Request $request, Languages $languages)
    {
        $languages = $languages->getAll();
        $data = $smallTests->searchById($id);

        $questionFormat = Constant::QUESTION_FORMAT;
        $optionDisplayFormat = Constant::OPTION_DISPLAY_FORMAT;
        $smallTestQuestions = $smallTests->searchSmallTestQuestionsBySmallTestId($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $smallTests->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        $arrLang = [];
        foreach ($languages AS $el) $arrLang[] = $el->lang_code;
        $arrLang = implode(',', $arrLang);
        return view('small_test.edit', compact('data','smallTestQuestions', 'questionFormat','optionDisplayFormat','params', 'languages', 'arrLang'));
    }

    /**
     * @param SmallTests $smallTests
     * @param Languages $languages
     * @param Collections $collections
     * @param Versions $versions
     * @param ComaCategories $comaCategories
     * @param Request $request
     * @param null $gradeId
     * @param null $versionId
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function action( SmallTests $smallTests, Languages $languages, Collections $collections, Versions $versions, ComaCategories $comaCategories, Request $request, $gradeId=null, $versionId=null, $id=null )
    {
        $languages = $languages->getAll();
        $data = $smallTests->searchById($id);
        $path_media  = Constant::S3_URL . DS . Constant::S3_BUCKET_URL . DS;
        $questionFormat = Constant::QUESTION_FORMAT;
        $questionFormatQuestions = Constant::QUESTION_FORMAT_QUESTIONS;

        $optionDisplayFormat = Constant::OPTION_DISPLAY_FORMAT;
        if(isset($_GET['small_test_question_title']) && $_GET['small_test_question_title'] != ''){
            $smallTestQuestions = $smallTests->searchSmallTestQuestionsBySmallTestId($id, $_GET['small_test_question_title']);
        }else {
            $smallTestQuestions = $smallTests->searchSmallTestQuestionsBySmallTestId($id, null);
        }
        $value_last_small_test_question = 0;
        $last_small_test_question = SmallTestQuestion::orderBy('id', 'desc')->first();
        if( count($last_small_test_question) > 0){
            $value_last_small_test_question = $last_small_test_question->id + 1;
        };
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $smallTests->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        $arrLang = [];
        $isInitChoice = isset($rsChoice) && is_array($rsChoice);
        $rsChoice=[];
        foreach ($languages AS $el) {
            $arrLang[] = $el->lang_code;
            if (!$isInitChoice) {
                for ($i = 0; $i < 4; $i++) {
                    $rsChoice[$el->lang_code][$i] = [];
                }
            }
        }
        $arrLang = implode(',', $arrLang);
        return view('small_test.action', compact('data','smallTestQuestions', 'path_media', 'questionFormat','questionFormatQuestions', 'optionDisplayFormat','params','gradeId', 'versionId', 'languages', 'arrLang', 'rsChoice', 'value_last_small_test_question'));

    }

    /**
     * @param $id
     * @param Request $request
     * @param SmallTests $smallTests
     * @param Languages $languages
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, SmallTests $smallTests, Languages $languages)
    {
        $languages = $languages->getAll();
        list($gradeId, $versionId, $id) = explode('-', $id);
        $smallTests->updateSmallTest($id, $request->except('_token'), $request, $languages);
        return redirect(route('small_tests.action', [$gradeId, $versionId, $id]));
    }

    /**
     * @param SmallTests $smallTests
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(SmallTests $smallTests, $id)
    {
        $smallTests->delete($id);
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $smallTests->action) {
            $params = Session::get('params');
            $params['current_id'] = $id - 1;
        }
        return redirect(route('contents.index', $params));
    }
    /**
     * @param Comas $comas
     * @param $id
     */
    public function destroyComa(Comas $comas, $id)
    {
        $comas->delete($id);
    }
    /**
     * @param Request $request
     * @param Chapters $chapters
     */
    public function createComa(Request $request, Chapters $chapters)
    {
        $chapters->createComa($request);
    }

    /**
     * @param Request $request
     * @param Chapters $chapters
     * @param $comaId
     */
    public function updateComa(Request $request, Chapters $chapters, $comaId)
    {
        $chapters->updateComa($request, $comaId);
    }
}
