<style>.wrapper, .exception-summary {display: none}</style><?php
use App\Models\Chapter;
use App\Models\Grade;
use App\Models\SmallTest;
use App\Models\SmallTestQuestion;
use App\Models\Version;
use Illuminate\Support\Facades\DB;

require __DIR__.'/../bootstrap/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$xmls = new \App\Repositories\Xmls();

$sql = "";
//grades	grade_no
$sql = "DELETE FROM `grade_names` WHERE grade_id IS NULL OR grade_id NOT IN (SELECT id FROM `grades`); \n";
$sql .= "DELETE FROM `big_tests` WHERE grade_id IS NULL OR grade_id NOT IN (SELECT id FROM `grades`); \n";
$sql .= "DELETE FROM `logs_big_test` WHERE big_test_id IS NULL OR big_test_id NOT IN (SELECT id FROM `big_tests`); \n";
$sql .= "DELETE FROM `messages_big_test` WHERE grade_id IS NULL OR (grade_id NOT IN (SELECT id FROM `grades`) AND big_test_id NOT IN (SELECT id FROM `big_tests`)); \n";
$sql .= "DELETE FROM `my_background_pages` WHERE grade_id IS NULL OR grade_id NOT IN (SELECT id FROM `grades`); \n";
//versions	version_no	grade_id
$sql .= "DELETE FROM `versions` WHERE grade_id IS NULL OR grade_id NOT IN (SELECT id FROM `grades`); \n";
//chapters	chapter_no	version_id
$sql .= "DELETE FROM `chapters` WHERE version_id IS NULL OR version_id NOT IN (SELECT id FROM `versions`); \n";
$sql .= "DELETE FROM `chapter_names` WHERE chapter_id IS NULL OR chapter_id NOT IN (SELECT id FROM `chapters`); \n";
$sql .= "DELETE FROM `logs_chapter` WHERE chapter_id IS NULL OR chapter_id NOT IN (SELECT id FROM `chapters`); \n";
//comas	frame_no	chapter_id
$sql .= "DELETE FROM `comas` WHERE chapter_id IS NULL OR chapter_id NOT IN (SELECT id FROM `chapters`); \n";
$sql .= "DELETE FROM `coma_languages` WHERE coma_id IS NULL OR coma_id NOT IN (SELECT id FROM `comas`); \n";
//small_test_questions	question_no	small_test_id
$sql .= "DELETE FROM `small_tests` WHERE id IN (49, 81, 454) OR chapter_id IS NULL OR chapter_id NOT IN (SELECT id FROM `chapters`); \n";
$sql .= "DELETE FROM `small_test_questions` WHERE small_test_id IS NULL OR small_test_id NOT IN (SELECT id FROM `small_tests`); \n";
$sql .= "DELETE FROM `logs_small_test` WHERE small_test_id IS NULL OR small_test_id NOT IN (SELECT id FROM `small_tests`); \n";
$sql .= "DELETE FROM `messages_small_test` WHERE grade_id IS NULL OR (grade_id NOT IN (SELECT id FROM `grades`) AND small_test_id NOT IN (SELECT id FROM `small_tests`)); \n";
//small_test_question_choices	choice_no	small_test_question_id
$sql .= "DELETE FROM `small_test_question_choices` WHERE small_test_question_id IS NULL OR small_test_question_id NOT IN (SELECT id FROM `small_test_questions`); \n";

// xmls
$sql .= "TRUNCATE `xmls`; \n ";

//No.1
$sql .= $xmls->resetFieldNo('grades', 'grade_no', "", true);
$grades = Grade::all()->sortBy('grade_no');
foreach ($grades as $key => $v_grade) {
    //No.2
    $sql .= $xmls->resetFieldNo('versions', 'version_no', "grade_id=" . ($v_grade->id), true);
    $versions = Version::where('grade_id', $v_grade->id)->orderBy('grade_id')->orderBy('version_no')->get();
    if (count($versions) > 0) {
        foreach ($versions as $key_ver => $v_version) {
            //No.3
            $sql .= $xmls->resetFieldNo('chapters', 'chapter_no', "version_id=" . ($v_version->id), true);
            $chapters = Chapter::where('version_id', $v_version->id)->orderBy('version_id')->orderBy('chapter_no')->get();
            if (count($chapters) > 0) {
                foreach ($chapters as $key_chap => $v_chapters) {
                    //No.4
                    $sql .= $xmls->resetFieldNo('comas', 'frame_no', "chapter_id=" . ($v_chapters->id), true);
                    $_small_tests = SmallTest::where('chapter_id', $v_chapters->id)->get();
                    if (count($_small_tests) > 0) {
                        foreach ($_small_tests as $small_tests) {
                            //No.5
                            $sql .= $xmls->resetFieldNo('small_test_questions', 'question_no', "small_test_id=" . ($small_tests->id), true);
                            //No.6
                            $small_test_questions = SmallTestQuestion::where('small_test_id', $small_tests->id)
                                ->orderBy('small_test_id')
                                ->orderBy('question_no')->get();
                            if (count($small_test_questions) > 0) {
                                foreach ($small_test_questions as $key_stq => $v_small_test_question) {
                                    $sql .= $xmls->resetFieldNo('small_test_question_choices', 'choice_no', "small_test_question_id=" . ($v_small_test_question->id), true);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
echo str_replace("\n", "<br />", $sql);die;