<?php

namespace App\Repositories;


use App\Models\BigTest;
use App\Models\Version;
use Illuminate\Support\Facades\DB;

class Versions extends Repository
{
    /**
     * Versions constructor.
     */
    public function __construct()
    {
        parent::__construct(new Version());
    }


    /**
     * Copy version with nested relationships
     * @param int $id
     */
    public function copyVersion($id)
    {
        $version = Version::with('chapters.chapter_names',
            'chapters.small_tests.small_test_questions.small_test_question_choices',
            'chapters.small_tests.small_test_questions.small_test_question_problems',
            'chapters.small_tests.messages_small_test', 'chapters.small_tests.logs_small_test',
            'chapters.comas.coma_languages', 'chapters.comas.logs_coma.logs_tips', 'chapters.bookmarks')
            ->find($id);

        $version->published = 0; // unpublish clone version

        DB::beginTransaction();


        try
        {
            $xmls = new Xmls();

            // Replicate versions
            $versionClone = $version->replicate();
            $versionClone->push();
            $versionId = $versionClone->id;

            $xmls->resetFieldNo('versions', 'version_no', "grade_id=" . ($versionClone->grade_id));

            // Replicate chapters
            foreach ($version->getRelation('chapters') as $chapterIndex => $chapterValue) {
                $chapterClone = $chapterValue->replicate();
                $chapterClone->version_id = $versionId;
                $chapterClone->push();
                $chapterId = $chapterClone->id;

                $xmls->resetFieldNo('chapters', 'chapter_no', "version_id=" . $versionId);

                // Replicate chapter_names
                foreach ($chapterValue->getRelation('chapter_names') as $chapterNameIndex => $chapterNameValue) {
                    $chapterNameClone = $chapterNameValue->replicate();
                    $chapterNameClone->chapter_id = $chapterId;
                    $chapterNameClone->push();
                }

                // Replicate small tests
                foreach ($chapterValue->getRelation('small_tests') as $smallTestIndex => $smallTestValue) {
                    $smallTestClone = $smallTestValue->replicate();
                    $smallTestClone->chapter_id = $chapterId;
                    $smallTestClone->push();
                    $smallTestId = $smallTestClone->id;
                    foreach ($smallTestValue->getRelation('small_test_questions') as $smallTestQuestionIndex => $smallTestQuestionValue) {
                        $smallTestQuestionClone = $smallTestQuestionValue->replicate();
                        $smallTestQuestionClone->small_test_id = $smallTestId;
                        $smallTestQuestionClone->push();
                        $smallTestQuestionId = $smallTestQuestionClone->id;

                        foreach ($smallTestQuestionValue->getRelation('small_test_question_choices') as $smallTestQuestionChoiceIndex => $smallTestQuestionChoiceValue) {
                            $smallTestQuestionChoiceClone = $smallTestQuestionChoiceValue->replicate();
                            $smallTestQuestionChoiceClone->small_test_question_id =  $smallTestQuestionId;
                            $smallTestQuestionChoiceClone->push();
                        }
                        $xmls->resetFieldNo('small_test_question_choices', 'choice_no', "small_test_question_id=" . $smallTestQuestionId);

                        foreach ($smallTestQuestionValue->getRelation('small_test_question_problems') as $smallTestQuestionProblemIndex => $smallTestQuestionProblemValue) {
                            $smallTestQuestionProblemClone = $smallTestQuestionProblemValue->replicate();
                            $smallTestQuestionProblemClone->small_test_question_id =  $smallTestQuestionId;
                            $smallTestQuestionProblemClone->push();
                        }
                    }
                    $xmls->resetFieldNo('small_test_questions', 'question_no', "small_test_id=" . $smallTestId);

                    foreach ($smallTestValue->getRelation('logs_small_test') as $logsSmallTestIndex => $logsSmallTestValue) {
                        $logsSmallTestClone = $logsSmallTestValue->replicate();
                        $logsSmallTestClone->small_test_id = $smallTestId;
                        $logsSmallTestClone->push();
                    }

                    foreach ($smallTestValue->getRelation('messages_small_test') as $messageSmallTestIndex => $messageSmallTestValue) {
                        $messageSmallTestClone = $messageSmallTestValue->replicate();
                        $messageSmallTestClone->small_test_id = $smallTestId;
                        $messageSmallTestClone->push();
                    }


                }

                // Replicate comas
                foreach ($chapterValue->getRelation('comas') as $comaIndex => $comaValue) {
                    $comaClone = $comaValue->replicate();
                    $comaClone->chapter_id = $chapterId;
                    $comaClone->push();
                    $comaId = $comaClone->id;

                    foreach ($comaValue->getRelation('coma_languages') as $comaLanguageIndex => $comaLanguageValue) {
                        $comaLanguageClone = $comaLanguageValue->replicate();
                        $comaLanguageClone->coma_id = $comaId;
                        $comaLanguageClone->push();
                    }

                    foreach($comaValue->getRelation('logs_coma') as $logsComaIndex => $logsComaValue) {
                        $logsComaClone = $logsComaValue->replicate();
                        $logsComaClone->coma_id = $comaId;
                        $logsComaClone->push();
                    }
                }
                $xmls->resetFieldNo('comas', 'frame_no', "chapter_id=" . $chapterId);
            }
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollback();
            $errorMessage = 'Copy version error: ID: '. $id . ', message:' . $e->getMessage();
            \Log::info(print_r($errorMessage, true));
        }
    }


    /**
     * Delete version by id
     * @param  int $id
     */
    public function deleteVersion($id)
    {
        $version = Version::find($id);
        DB::beginTransaction();
        try
        {
            $version->delete();
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollback();
            $errorMessage = 'Delete version error: ID: '. $id . ', message:' . $e->getMessage();
            \Log::info(print_r($errorMessage, true));
        }

        $xmls = new Xmls();
        $xmls->resetFieldNo('versions', 'version_no', "grade_id=" . ($version->grade_id));
    }

    /**
     * Publish version by id
     * @param int $id
     */
    public function publishVersion($id) {
        $version = Version::find($id);
        if (is_object($version)) {
            $version->published = 1;
            $version->release_date_chapter = date('Y-m-d H:i:s');
            $version->save();
        }

    }

    /**
     * Unpublish version by id
     * @param int $id
     */
    public function unpublishVersion($id) {
        $version = Version::find($id);
        if (is_object($version)) {
            $version->published = 0;
            $version->save();
        }
    }

    /**
     * Check version is existing by grade id
     * @param $gradeId
     * @return int
     */
    public function checkVersionExistWithGrade($gradeId) {
        return Version::where('grade_id', $gradeId)->count();
    }

    public function createVersion($gradeId, $versionName = '') {
        $result = null;
        $published = 0;
        if ($this->checkVersionExistWithGrade($gradeId) == 0) {
            $published = 1;
        }
        if (empty($versionName)) {
            $versionName = 'バージョン1';
        }
        $big_tests = BigTest::where('grade_id', $gradeId)->first();
        if(count($big_tests)>0){
            $big_test_id = $big_tests->id ;
        }else{
            $big_test = new BigTest();
            $big_test->grade_id = $gradeId;
            $big_test->save();
            $big_test_id = $big_test->id;

        }
        $newVersion = array( 'grade_id' => $gradeId, 'name' => $versionName, 'relate_version' => md5(time()),
            'release_date_chapter' => date('Y-m-d H:i:s'), 'release_date_small_test' => date('Y-m-d H:i:s'),
            'chapter_collection_id' => 0, 'big_test_id' =>  $big_test_id, 'file_id_version' => time(), 'folder_id_version' => time(), 'file_id_release' => time(),
            'created_at' => date('Y-m-d H:i:s'), 'updated_at' =>  date('Y-m-d H:i:s') , 'published' => $published);
        $result = $this->create($newVersion);

        $xmls = new Xmls();
        $xmls->resetFieldNo('versions', 'version_no', "grade_id=" . $gradeId);
        return $result->id;
    }
}