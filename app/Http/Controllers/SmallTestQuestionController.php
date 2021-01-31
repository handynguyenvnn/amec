<?php

namespace App\Http\Controllers;

use App\Models\SmallTestQuestionProblem;
use App\Repositories\Versions;
use Illuminate\Http\Request;
use App\Repositories\SmallTestQuestions;
use App\Models\SmallTestQuestionChoice;
use App\Repositories\Languages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SmallTestQuestionController extends Controller
{
    public function getByAjax(SmallTestQuestions $smallTestQuestions, $id, Languages $languages)
    {
        $smallTestQuestions = $smallTestQuestions->getByAjax($id, $languages);
        return response()->json($smallTestQuestions); // AJAX JS:
    }

    public function searchByAjax(SmallTestQuestions $smallTestQuestions, $name, $smallTestId)
    {
        $smallTestQuestions = $smallTestQuestions->searchByAjax($name, $smallTestId);
        return response()->json($smallTestQuestions);
    }

    public function destroy(SmallTestQuestions $smallTestQuestions, $id)
    {
        $smallTestQuestions->delete($id);
        return redirect(route('chapters.index'));
    }

    public function store(Request $request, SmallTestQuestions $smallTestQuestions, Versions $versions)
    {
        $gradeId = $request->except('_token')['gradeId'];
        $versionId = $request->except('_token')['versionId'];
        $versionName =  $request->except('_token')['version_name'];
        // In case create a new version
        if (empty($versionId)) {
            $versionId = $versions->createVersion($gradeId, $versionName);
            return redirect(route('chapters.list', [$gradeId, $versionId])); // to create new chapter
        }
        else  if (!empty($versionName)){ // Update existing version
            $versions->update($versionId, array('name' => $versionName));
        }

        $smallTestQuestions->store($request->except('_token'));
        return redirect(route('chapters.list', [$gradeId, $versionId]));
    }

    public function create( Request $request, SmallTestQuestions $smallTestQuestions)
    {
        return $smallTestQuestions->createSmallTestQuestion($request->except('_token'));
    }
    public function update(Request $request, SmallTestQuestions $smallTestQuestions, $id)
    {
        return $smallTestQuestions->updateSmallTestQuestion($request->except('_token'), $id);
    }
    public function destroySmallTest(SmallTestQuestions $smallTestQuestions, $id)
    {
        $smallTestQuestions->delete($id);
    }
    public function destroySmallTestChoice(SmallTestQuestions $smallTestQuestions, $id){
        $small_test_question_choice_find = SmallTestQuestionChoice::find($id);
        if(count($small_test_question_choice_find)>0){
            $small_test_question_id = $small_test_question_choice_find->small_test_question_id;
            $language_id = $small_test_question_choice_find->language_id;
            $option_value = $small_test_question_choice_find->option_value;
            $small_test_question_choices = DB::table('small_test_question_choices')
                ->where('small_test_question_id', $small_test_question_id)
                ->where('language_id', $language_id)
                ->get();
            foreach( $small_test_question_choices as $small_test_question_choice){
                if((int)$option_value < (int)$small_test_question_choice->option_value){
                    $small_test_question_choice_new = SmallTestQuestionChoice::find($small_test_question_choice->id);
                    $option_value = $small_test_question_choice_new->option_value;
                    $small_test_question_choice_new->option_value = (int)$option_value-1;
                    $small_test_question_choice_new->save();
                }
            }
            $small_test_question_choice_find->delete();
            return $small_test_question_choices;
        }
        return false;
    }
    public function deleteImage($id){
        $small_test_question_problems = SmallTestQuestionProblem::find($id);
        $path = $small_test_question_problems->image_path;
        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
        $small_test_question_problems->image_path = '';
        $small_test_question_problems->save();
        return 'successfull';
    }
    public function deleteVideo($id){
        $small_test_question_problems = SmallTestQuestionProblem::find($id);
        $path = $small_test_question_problems->video_path;
        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
        $small_test_question_problems->video_path = '';
        $small_test_question_problems->save();
        return 'successfull';
    }
    public function deleteImageChoice($id)
    {
        $small_test_question_choice = SmallTestQuestionChoice::find($id);
        if(count($small_test_question_choice)>0) {
            $option_value = $small_test_question_choice->option_value;
            $small_test_question_id = $small_test_question_choice->small_test_question_id;
            $small_test_question_choices = SmallTestQuestionChoice::where('small_test_question_id', $small_test_question_id)
                ->where('option_value', $option_value)->get();
            foreach ($small_test_question_choices as $temp_small_test_question_choice){
                $delete_small_test_question_choice = SmallTestQuestionChoice::find($temp_small_test_question_choice->id);
                $path = $delete_small_test_question_choice->image_path;
                if (Storage::disk('s3')->exists($path)) {
                    Storage::disk('s3')->delete($path);
                }
                $delete_small_test_question_choice->image_path = '';
                $delete_small_test_question_choice->save();
            }
        }
        return 'successfull';
    }
}
