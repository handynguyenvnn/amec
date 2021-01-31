<?php
namespace App\Http\Controllers;

use App\Models\BigTest;
use App\Models\Grade;
use App\Models\MyBackgroundPage;
use App\Repositories\BigTests;
use App\Repositories\Chapters;
use App\Repositories\SmallTests;
use App\Repositories\Versions;
use App\Repositories\Xmls;
use Illuminate\Http\Request;
use App\Repositories\Grades;
use App\Repositories\Collections;
use Illuminate\Support\Facades\Session;
use App\Libs\Constants\Constant;
use App\Repositories\Projects;
use App\Repositories\Languages;
use Sentinel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
/**
 * This class manage all function of Grades
 * Class GradeController
 * @package App\Http\Controllers
 */
class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Grades $grades
     * @param Collections $collections
     * @param Request $request
     * @param Projects $projects
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Grades $grades, Request $request, Collections $collections, Projects $projects)
    {
        $data = $grades->search($request->all());
        $contentType = Constant::CONTENT_TYPE_GRADE;
        $trophy = $collections->getTrophy();
        $project = $projects->getAll();
        $params = $request->except('current_id');
        return view('grade.list', compact('data','contentType','trophy', 'project', 'params'));
    }

    /**
     * @param Grades $grades
     * @param Collections $collections
     * @param Projects $projects
     * @param Chapters $chapters
     * @param SmallTests $smallTests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create( Grades $grades, Collections $collections, Projects $projects, Chapters $chapters, SmallTests $smallTests, Languages $languages)
    {
        $languages = $languages->getAll();
        $contentType = Constant::CONTENT_TYPE_GRADE;
        $trophy = $collections->getTrophy();
        $project = $projects->getAll();
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $grades->action) {
            $params = Session::get('params');
            $params['page'] = 1;
            unset($params['current_id']);
        }
        return view('grade.create', compact( 'grades', 'trophy','project','contentType', 'params', 'languages'));
    }

    /**
     * This function store data
     *
     * @param Request $request
     * @param Grades $grades
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Grades $grades, Languages $languages)
    {
        $data = $request->except('_token', '_method');

        if($data['content_type'] == 0) {
            $this->validate($request,
                array(
                    'content_type' => 'unique:grades,content_type',
                ),
                array(
                    'content_type.unique' => 'メールでのお問い合わせ。'
                )
            );
        }
        else
        {
            $this->validate($request,
                array(
                    'pass_score_rate' => 'nullable|integer|min:1|max:100',
                    'file.my_page_background' => 'nullable|file|image'
                )
            );
        }

        if (($request->file('my_page_background'))) {
            if($data['my_back_ground_id']) {
                $my_page_background = MyBackgroundPage::find($data['my_back_ground_id']);
            }else{
                $my_page_background = new MyBackgroundPage();
            }
            $year = date('Y');
            $month = date('m');
            $image_path = $request->file('my_page_background');
            $nameImage = str_random(15) . pathinfo($image_path)['filename'];
            $extImage = $image_path->guessClientExtension();
            if (Storage::disk('s3')->putFileAs('image/backgrounds/'.$year.DS.$month, $image_path, "{$nameImage}.{$extImage}", "public")) {
                $my_page_background->image_path = 'image/backgrounds/'.$year.DS.$month . DS . $nameImage . '.' . $extImage;
            } else {
                $my_page_background->image_path = Constant::NO_IMAGE;
            }
            $my_page_background->save();
        }

        $data['user_id'] = Sentinel::getUser()->id;
        $grades->createGrade($data, $languages->getAll());
        return redirect()->route('contents.index');
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
     * @param $id
     * @param Grades $grades
     * @param Chapters $chapters
     * @param SmallTests $smallTests
     * @param Collections $collections
     * @param Projects $projects
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id=null, Grades $grades, Chapters $chapters, SmallTests $smallTests, BigTests $bigTests, Collections $collections, Projects $projects, Languages $lang)
    {
        $path_media = Constant::S3_URL . DS . Constant::S3_BUCKET_URL . DS;
        if(intval($id) == 0){
            $id = DB::table('grades')->max('id') + 1;
            $grade = new Grade();
            $grade->id = $id;
            $grade->grade_no = DB::table('grades')->max('grade_no') + 1;
            $grade->content_type = 1;
            $grade->save();
            return redirect(route('grades.edit', $id));
        }
        $languages = $lang->getAll();
        // Get pass score rate
        $passScoreRate = $grades->getPassScoreRate($id);
        // Get my page background
        $myPageBg = $grades->getMyPageBg($id);
        $grade = Grade::find($id);
        if(!(count($grade)>0)){
            return redirect(route('contents.index'));
        }
        // Get grades
        $grades = $grades->getGradeById($id);
        $contentType = Constant::CONTENT_TYPE_GRADE;
        $trophy = $collections->getTrophy();
        $project = $projects->getAll();
        $data = $chapters->searchChapterByGradeId($id);

        // Find published version
        $currentPublished = 0;
        foreach($data as $item) {
            if ($item->version_published == 1) {
                $currentPublished = $item->id;
                break;
            }
        }
        $big_tests = BigTest::where('grade_id', $id)->first();
        $bigTests = $bigTests->getMessageByGradeId($id);

//        $small_test_id = $big_test_id = 0;
        foreach ($bigTests AS $el) {
//            if ($el->small_test_id > 0) {
//                $small_test_id = $el->small_test_id;
//            }
            if ($el->big_test_id > 0) {
                $big_test_id = $el->big_test_id;
            }
        }
        $params = [];
        if (Session::has('params')) {
            $params = Session::get('params');
            $params['current_id'] = $id;
        }
        Session::put('grade_id', $id);
        return view('grade.edit', compact('data','grades', 'path_media', 'bigTests','smallTests', 'trophy','project','contentType',
                    'params', 'languages', 'small_test_id', 'big_test_id', 'currentPublished', 'passScoreRate', 'myPageBg', 'big_tests'));
    }

    /**
     * This function update data
     *
     * @param Request $request
     * @param $id
     * @param Grades $grades
     * @return \Illuminate\Http\RedirectResponse
     */
//    public function update($id, Request $request, Grades $grades, Languages $lang, Xmls $xmls)
    public function update($id, Request $request, Grades $grades, Languages $lang)

    {
        $data = $request->except('_token', '_method');
        $grade = $grades->getGradeById($id);
        $grade_content_type = (isset($grade['content_type'])) ? $grade['content_type'] : Constant::CONTENT_TYPE_GRADE_IS_COMA;
        if(isset($data['content_type'])) {
            if (($data['content_type'] == Constant::CONTENT_TYPE_GRADE_IS_TUTORIAL) && ($data['content_type']) != $grade_content_type) {
                $this->validate($request,
                    array(
                        'content_type' => 'unique:grades,content_type',
                    ),
                    array(
                        'content_type.unique' => 'メールでのお問い合わせ。'
                    )
                );
            }
        }
        if (($request->file('my_page_background'))) {
            if(isset($data['my_back_ground_id'])) {
                $my_page_background = MyBackgroundPage::find($data['my_back_ground_id']);
            }else{
                $my_page_background = new MyBackgroundPage();
            }
                $image_path = $request->file('my_page_background');
                $nameImage = str_random(15) . pathinfo($image_path)['filename'];
                $extImage = $image_path->guessClientExtension();
                $year = date('Y');
                $month = date('m');
                if (Storage::disk('s3')->putFileAs('image/backgrounds/'.$year.DS.$month, $image_path, "{$nameImage}.{$extImage}", "public")) {
                    $my_page_background->image_path = 'image/backgrounds/'.$year.DS.$month . DS . $nameImage . '.' . $extImage;
                } else {
                    $my_page_background->image_path = Constant::NO_IMAGE;
                }
            $my_page_background->grade_id = $id;
            $my_page_background->save();
        }

        $data['user_id'] = Sentinel::getUser()->id;
        $grades->updateGrade($id, $data, $lang->getAll());
        return redirect(route('contents.index'));
    }

    /**
     * This function destroy data
     *
     * @param Grades $grades
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Grades $grades, $id)
    {
        $params = [];
        if (Session::has('params') && Session::get('params.action') == $grades->action) {
            $params = Session::get('params');
            $params['current_id'] = $id - 1;
        }
        $grades->deleteGrade($id);
        return redirect(route('contents.index', $params));

    }

    /**
     * Copy version with nested relationships
     * @param Request $request
     * @param Versions $versions
     * @return \Illuminate\Http\JsonResponse
     */
    public function versionCopy(Request $request, Versions $versions) {
        $id = $request->get('id');
        $versions->copyVersion($id);
        return response()->json([
            'success' => '1'
        ]);

    }

    /**
     * Publish version
     * @param Request $request
     * @param Versions $versions
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publishVersion(Request $request, Versions $versions, $id)
    {
        $currentPublished = $request->get('current_published');
        if ($currentPublished != $id)
        {
            $versions->publishVersion($id);
            $versions->unpublishVersion($currentPublished);
        }

        return redirect()->route('grades.edit', Session::get('grade_id'));
    }


    /**
     * Delete version
     * @param Versions $versions
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteVersion(Versions $versions, $id)
    {

        $versions->deleteVersion($id);
        return redirect()->route('grades.edit', Session::get('grade_id'));
    }
    public function deleteImage($id){
        $my_back_ground_page = MyBackgroundPage::where('grade_id', $id)->first();
        if(count($my_back_ground_page)>0){
            $path = $my_back_ground_page->image_path;
            Storage::disk('s3')->delete($path);
            $my_back_ground_page->image_path = '';
            $my_back_ground_page->save();
        }
        return redirect()->route('grades.edit', $id);

    }


}
