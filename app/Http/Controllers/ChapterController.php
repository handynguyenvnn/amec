<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Coma;
use App\Models\ComaCategory;
use App\Models\ComaLanguage;
use App\Models\Grade;
use App\Models\Language;
use App\Models\SmallTest;
use App\Models\SmallTestQuestion;
use App\Models\SmallTestQuestionChoice;
use App\Models\SmallTestQuestionProblem;
use App\Models\Version;
use App\Repositories\ChapterNames;
use App\Repositories\Chapters;
use App\Repositories\Grades;
use App\Repositories\Languages;
use App\Repositories\Xmls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;
use App\Repositories\MessagesSmallTests;
use App\Repositories\Collections;
use App\Repositories\Versions;
use App\Repositories\Comas;
use App\Repositories\SmallTests;
use App\Repositories\ComaCategories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ChapterController extends Controller
{
    public function show($id)
    {
        //
    }

    /**
     * @param Chapters $chapters
     * @param Languages $languages
     * @param Request $request
     * @param null $gradeId
     * @param null $versionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listAll( Chapters $chapters, Languages $languages, Request $request, $gradeId = null, $versionId = null)
    {
        $languages = $languages->getAll();
        if($gradeId == null) { $gradeId = Grade::first()->id;}

        $data = array();
        if (!empty ($versionId)) {
            $data = $chapters->search($request->all(), $versionId);
        }

        $params = $request->except('current_id');
        $categoryMessages = Constant::CATEGORY_MESSAGE;
        $versionName = null;
        $version = Version::find($versionId);
        if (is_object($version)) {
            $versionName = $version->name;
        }
        $messages_small_tests = $chapters->get_messages_small_test($gradeId);
        return view('chapter.list', compact('data', 'categoryMessages', 'params', 'gradeId', 'versionId', 'languages', 'versionName', 'messages_small_tests'));

    }

    /**
     * @param Chapters $chapters
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
    public function action( Chapters $chapters, Languages $languages, Collections $collections, Versions $versions, ComaCategories $comaCategories, Request $request, $gradeId=null, $versionId=null, $id=null )
    {
        $path_media  = Constant::S3_URL . DS . Constant::S3_BUCKET_URL . DS;
        $languages = $languages->getAll();

        $data = $chapters->searchById($id);
        $optionCollection = $collections->getAll();
        $optionVersion = $versions->getAll();
        $optionComaCategory = ComaCategory::where('language_id', Constant::LANG_JA_ID)->get();
        if(isset($_GET['coma_name']) && $_GET['coma_name'] != ''){
            $comas = $chapters->searchComaByChapterId($id, $_GET['coma_name']);
        }else {
            $comas = $chapters->searchComaByChapterId($id, null);
        }
        $chapter_names = $chapters->searchChapterNameByChapterId($id);
        $value_last_coma = 0;
        $last_coma = Coma::orderBy('id', 'desc')->first();
        if( count($last_coma) > 0){
            $value_last_coma = $last_coma->id + 1;
        };
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $chapters->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        $arrLang = [];
        foreach ($languages AS $el) $arrLang[] = $el->lang_code;
        $arrLang = implode(',', $arrLang);
        return view('chapter.action', compact('params', 'data', 'path_media', 'value_last_coma', 'chapter_names', 'languages', 'optionCollection', 'optionVersion', 'optionComaCategory', 'gradeId', 'versionId', 'id', 'comas', 'arrLang'));

    }

    public function listByGrade($gradeId, Chapters $chapters, MessagesSmallTests $messagesSmallTests, Request $request)
    {
        $data = $chapters->searchByGrade($request->all(), $gradeId);
        $params = $request->except('current_id');
        $categoryMessages = Constant::CATEGORY_MESSAGE;
        return view('chapter.list', compact('data', 'categoryMessages', 'params', 'gradeId'));
    }


    /**
     * @param Chapters $chapters
     * @param Collections $collections
     * @param Versions $versions
     * @param ComaCategories $comaCategories
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Chapters $chapters, Collections $collections, Versions $versions, ComaCategories $comaCategories)
    {
        $optionCollection = $collections->getAll();
        $optionVersion = $versions->getAll();
        $optionComaCategory = $comaCategories->getAll();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $chapters->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('chapter.create', compact('params', 'optionCollection', 'optionVersion', 'optionComaCategory'));
    }

    /**
     * @param Request $request
     * @param Chapters $chapters
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($id, Request $request, Chapters $chapters, Languages $languages)
    {
        $languages = $languages->getAll();

        $chapters->createChapter($request->except('_token'), $_FILES, $languages);

        //return redirect(route('chapters.list', [$params->grade_id, $params->version_id]));

        return redirect()->route('chapters.index');
    }

    /**
     * @param $id
     * @param Chapters $chapters
     * @param Collections $collections
     * @param Versions $versions
     * @param ComaCategories $comaCategories
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Chapters $chapters, Collections $collections, Versions $versions, ComaCategories $comaCategories, Request $request)
    {
        $data = $chapters->searchById($id);
        $chapterId = $id;
        $optionCollection = $collections->getAll();
        $optionVersion = $versions->getAll();
        $optionComaCategory = $comaCategories->getAll();
        $comas = $chapters->searchComaByChapterId($chapterId, $request->all());

        $params = [];
        if (Session::has('params') && Session::get('params.action') == $chapters->action) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        return view('chapter.edit', compact('data', 'chapterId', 'optionCollection', 'optionVersion', 'optionComaCategory', 'comas', 'params'));
    }

    /**
     * @param $id
     * @param Request $request
     * @param Chapters $chapters
     * @param Languages $languages
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id = null, Request $request, Chapters $chapters, Languages $languages)
    {
        $languages = $languages->getAll();
        list($gradeId, $versionId, $id) = explode('-', $id);
        $data = $request->except('_token');
        $data['version_id'] = $versionId;
        $data['grade_id'] = $gradeId;
        $chapters->updateChapter($id, $data , $request, $languages);
        if($id == null){
            $id = DB::table('chapters')->max('id');
        }
            return redirect(route('chapters.action', [$gradeId, $versionId, $id]));

    }

    /**
     * @param null $gradeId
     * @param null $versionId
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove( $gradeId=null, $versionId=null, $id=null)
    {
        $chapters = Chapter::find($id);
        $chapters->delete();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $chapters->action) {
            $params = Session::get('params');
            $params['current_id'] = $id - 1;
        }

        $xmls = new Xmls();
        $xmls->resetFieldNo('chapters', 'chapter_no', "version_id=" . $versionId);

        return redirect(route('chapters.list', [$gradeId, $versionId], $params));
    }

    public function removeComa( $gradeId=null, $versionId=null,$chapterId=null, $id=null)
    {
        $coma_languages = ComaLanguage::where('coma_id', $id)->get();
        foreach ($coma_languages as $coma_language){
            $image_path = $coma_language->image_path;
            if (Storage::disk('s3')->exists($image_path)) {
                Storage::disk('s3')->delete($image_path);
            }
            $music_path = $coma_language->music_path;
            if (Storage::disk('s3')->exists($music_path)) {
                Storage::disk('s3')->delete($music_path);
            }
            $video_path = $coma_language->video_path;
            if (Storage::disk('s3')->exists($video_path)) {
                Storage::disk('s3')->delete($video_path);
            }
        }
        $coma = Coma::find($id);
        $coma->delete();

        $xmls = new Xmls();
        $xmls->resetFieldNo('comas', 'frame_no', "chapter_id=" . $chapterId);
        return redirect(route('chapters.action', [$gradeId, $versionId, $chapterId]));
    }
    public function removeSmallTestQuestion ( $gradeId=null, $versionId=null,$smallTestId=null, $id=null) {

        $small_test_question_problems = SmallTestQuestionProblem::where('small_test_question_id', $id)->get();
        foreach($small_test_question_problems as $small_test_question_problem){
            $image_path = $small_test_question_problem->image_path;
            if (Storage::disk('s3')->exists($image_path)) {
                Storage::disk('s3')->delete($image_path);
            }
            $video_path = $small_test_question_problem->video_path;
            if (Storage::disk('s3')->exists($video_path)) {
                Storage::disk('s3')->delete($video_path);
            }
            SmallTestQuestionProblem::destroy($small_test_question_problem->id);
        }

        $small_test_question_choices = SmallTestQuestionChoice::where('small_test_question_id', $id)->get();
        foreach($small_test_question_choices as $small_test_question_choice) {
            $image_path = $small_test_question_choice->image_path;
            if (Storage::disk('s3')->exists($image_path)) {
                Storage::disk('s3')->delete($image_path);
            }
            SmallTestQuestionChoice::destroy($small_test_question_choice->id);
        }
        $smallTestQuestion = SmallTestQuestion::find($id);
        $smallTestQuestion->delete();

        $xmls = new Xmls();
        $xmls->resetFieldNo('small_test_questions', 'question_no', "small_test_id=" . $smallTestId);
        $xmls->resetFieldNo('small_test_question_choices', 'choice_no', "small_test_question_id=" . $id);

        return redirect(route('small_tests.action', [$gradeId, $versionId, $smallTestId]));
    }
    public function removeSmallTest( $gradeId=null, $versionId=null,$smallTestId=null, $id=null)
    {
        $smallTestQestion = SmallTestQuestion::find($id);
        $smallTestQestion->delete();

        return redirect(route('small_tests.action', [$gradeId, $versionId, $smallTestId]));
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
    public function deleteImage($id){
        $comaLanguage = ComaLanguage::find($id);
        $path = $comaLanguage->image_path;
        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
        $comaLanguage->image_path = '';
        $comaLanguage->save();
        return 'successfull';
    }
    public function deleteAudio($id){
        $comaLanguage = ComaLanguage::find($id);
        $path = $comaLanguage->music_path;
        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
        $comaLanguage->music_path = '';
        $comaLanguage->save();
        return 'successfull';
    }
    public function deleteVideo($id){
        $comaLanguage = ComaLanguage::find($id);
        $path = $comaLanguage->video_path;
        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
        $comaLanguage->video_path = '';
        $comaLanguage->save();
        return 'successfull';
    }
}
