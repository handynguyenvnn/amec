<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//use App\Models\Account;
use App\Models\Ad;
use App\Models\AdministratorTransmissionHistory;
use App\Models\AdVideo;
use App\Models\Announcement;
use App\Models\Area;
//use App\Models\Authority;
use App\Models\BigTest;
use App\Models\Bookmark;
use App\Models\Certificate;
use App\Models\Chapter;
use App\Models\ChapterName;
use App\Models\ChatTool;
use App\Models\Collection;
use App\Models\Coma;
use App\Models\ComaCategory;
use App\Models\ComaLanguage;
use App\Models\Grade;
use App\Models\GradeName;
use App\Models\Guide;
use App\Models\Language;
use App\Models\Level;
use App\Models\LogActiveTime;
use App\Models\LogBigTest;
use App\Models\LogComa;
use App\Models\LogLogin;
use App\Models\LogSmallTest;
use App\Models\LogTips;
use App\Models\Maker;
use App\Models\MessageBigTest;
use App\Models\MessageSmallTest;
use App\Models\MessageTips;
use App\Models\MessageTrophySetting;
use App\Models\MyBackgroundPage;
use App\Models\NotificationSetting;
//use App\Models\PossessionAuthority;
use App\Models\PossessionCertificate;
use App\Models\PossessionCollection;
use App\Models\Profession;
use App\Models\Project;
use App\Models\SmallTest;
use App\Models\SmallTestQuestion;
use App\Models\SmallTestQuestionChoice;
use App\Models\SmallTestQuestionProblem;
use App\Models\Tag;
use App\Models\Term;
use App\Models\Tips;
use App\Models\TrophyRank;
use App\Models\TrophySetting;
use App\Models\Type;
use App\Models\User;
use App\Models\UserTransmissionHistory;
use App\Models\Version;
use Faker\Generator;
use App\Models\CardAppearanceRate;


$autoIncrement_grades = autoIncrement_grades();
$autoIncrement_collections = autoIncrement_collections();
$autoIncrement_makes = autoIncrement_makes();
$autoIncrement_levels = autoIncrement_levels();
$autoIncrement_tags = autoIncrement_tags();
$autoIncrement_grade_names = autoIncrement_grade_names();
$autoIncrement_chapters = autoIncrement_chapters();
$autoIncrement_versions = autoIncrement_versions();
$autoIncrement_small_tests = autoIncrement_small_tests();
$autoIncrement_announcements = autoIncrement_announcements();
$autoIncrement_bookmarks = autoIncrement_bookmarks();
$autoIncrement_coma_categories = autoIncrement_coma_categories();
$autoIncrement_comas = autoIncrement_comas();
$autoIncrement_chapters_name = autoIncrement_chapters_name();
$autoIncrement_small_test_question_choices = autoIncrement_small_test_question_choices();
$autoIncrement_trophy_ranks = autoIncrement_trophy_ranks();


//Sample data seeder for accounts table

//$factory->define(Account::class, function (Generator $faker) {
//    return [
//        'name' => $faker->userName,
//        'login_id' => 'admin-' . $faker->unique()->randomNumber(),
//        'password' => bcrypt('12345'),
//        'lock' => $faker->boolean(),
//        'login_miss_times' => $faker->numberBetween(0, 10),
//    ];
//});

//Sample data seeder for authorities table
//$factory->define(Authority::class, function (Generator $faker) {
//    return [
//        'permission_point' => 'permission-' . $faker->unique()->randomNumber(),
//        'url' => $faker->url,
//    ];
//});

//Sample data seeder for possession_authorities table
//$factory->define(PossessionAuthority::class, function (Generator $faker) {
//    return [
//        'account_id' => function () {
//            return Account::inRandomOrder()->first()->id;
//        },
//        'authority_id' => function () {
//            return Authority::inRandomOrder()->first()->id;
//        },
//        'authority_available' => $faker->boolean(),
//    ];
//});

//Sample data seeder for ads table
$factory->define(Ad::class, function (Generator $faker) {
    return [
        'banner_ad' => $faker->boolean(),
        'gacha_ad' => $faker->boolean(),
        'content_ad' => $faker->boolean(),
    ];
});

//Sample data seeder for ad_videos table
$factory->define(AdVideo::class, function (Generator $faker) {
    return [
        'ad_id' => function () {
            return Ad::inRandomOrder()->first()->id;
        },
        'image_animation_path' => $faker->imageUrl($width = 640, $height = 480),
    ];
});

//Sample data seeder for users table
$factory->define(User::class, function (Generator $faker) {
    return [
        'email' => $faker->email,
        'password' => bcrypt('12345'),
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'username' => $faker->name,
        'gender' => $faker->boolean(),
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'), // '1979-06-09',
        'area_id' => function () {
            return Area::inRandomOrder()->first()->id;
        },
        'profession_id' => function () {
            return Profession::inRandomOrder()->first()->id;
        },
        'address' => $faker->state . ' ' . $faker->cityPrefix . ' ' . $faker->secondaryAddress,
        'phone' => $faker->tollFreePhoneNumber,
        'registration_date' => $faker->dateTimeBetween('-10year'),
        'last_login_date' => $faker->dateTimeThisMonth,
        'notification_setting_1' => 1,
        'notification_setting_2' => 1,
        'notification_setting_3' => 1,
        'contents' => $faker->text(),
        'sns_public_setting' => 1,
        'device_id' => $faker->uuid,
        'created_at' => date('Y-m-d H:i:s'),
    ];
});


//Sample data seeder for user_trasmission_history table
$factory->define(UserTransmissionHistory::class, function (Generator $faker) {
    return [
        'chat_tool_id' => function () {
            return ChatTool::inRandomOrder()->first()->id;
        },
        'sent_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'contents' => $faker->text(),
    ];
});

//Sample data seeder for administrator_trasmission_history
$factory->define(AdministratorTransmissionHistory::class, function (Generator $faker) {
    return [
        'chat_tool_id' => function () {
            return ChatTool::inRandomOrder()->first()->id;
        },
        'received_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'contents' => $faker->text(),
    ];
});


//Sample data seeder for chat_tools table
$factory->define(ChatTool::class, function (Generator $faker) {
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        }
    ];
});

//Sample data seeder for projects table
$factory->define(Project::class, function (Generator $faker) {
    return [
        'has_advertisement' => $faker->boolean(),
        'image_animation_path' => $faker->randomElement($array = array('https://www.youtube.com/watch?v=Q6dsRpVyyWs', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'https://www.youtube.com/watch?v=2idPJMuqhxs')),
        'folder_id' => 'Temp(folder_id languages)',
    ];
});

//Sample data seeder for grades table
$factory->define(Grade::class, function (Generator $faker) use ($autoIncrement_grades) {
    $autoIncrement_grades->next();


    return [
        'project_id' => function () {
            return Project::inRandomOrder()->first()->id;
        },
        'grade_no' => $autoIncrement_grades->current(),
        'content_type' => $faker->boolean(),
        'folder_id' => 'Temp(folder_id grade)',
        'file_id' => 'Temp(file_id grade setting)',
    ];
});

//Sample data seeder for my_background_pages table
$factory->define(MyBackgroundPage::class, function (Generator $faker) {
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'grade_id' => function () {
            return Grade::inRandomOrder()->first()->id;
        },
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
    ];
});

//Sample data seeder for tips table
$factory->define(Tips::class, function (Generator $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    return [
        'project_id' => function () {
            return Project::inRandomOrder()->first()->id;
        },
        'has_small_test' => $faker->boolean(),
        'control_no' => $faker->unique()->taxId(),
        'file_id' => 'Temp(file_id Tips setting)',
        'folder_id' => 'Temp(folder_id Tips)',
    ];
});

//Sample data seeder for big_tests table
$factory->define(BigTest::class, function (Generator $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    return [
        'grade_id' => function () {
            return Grade::inRandomOrder()->first()->id;
        },
        'pass_score_rate' => $faker->numberBetween(0, 100),
        'control_no' => $faker->unique()->taxId(),
        'collection_id' => function () {
            return Collection::inRandomOrder()->first()->id;
        },
        'file_id' => 'Temp(file_id big test)',
    ];
});

//Sample data seeder for trophy_ranks table
$factory->define(TrophyRank::class, function (Generator $faker) use ($autoIncrement_trophy_ranks) {
    $autoIncrement_trophy_ranks->next();
    return [
        'trophy_rank' => 'Rank ' . $autoIncrement_trophy_ranks->current(),
    ];
});

//Sample data seeder for collections table
$factory->define(Collection::class, function (Generator $faker) use ($autoIncrement_collections) {
    $autoIncrement_collections->next();


    return [
        'name' => 'Collection ' . $autoIncrement_collections->current(),
        'maker_id' => function () {
            return Maker::inRandomOrder()->first()->id;
        },
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'level_id' => function () {
            return Level::inRandomOrder()->first()->id;
        },
        'description' => $faker->text(),
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
        'tag_id' => function () {
            return Tag::inRandomOrder()->first()->id;
        },
        'collection_no' => $autoIncrement_collections->current(),
        'type_id' => function () {
            return Type::inRandomOrder()->first()->id;
        },
        'youtube_link' => $faker->randomElement($array = array('https://www.youtube.com/watch?v=Q6dsRpVyyWs', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'https://www.youtube.com/watch?v=2idPJMuqhxs')),
        'grade_id' => function () {
            return Grade::inRandomOrder()->first()->id;
        },
        'trophy_rank_id' => function () {
            return TrophyRank::inRandomOrder()->first()->id;
        },
    ];
});


//Sample data seeder for makers table
$factory->define(Maker::class, function (Generator $faker) use ($autoIncrement_makes) {
    $autoIncrement_makes->next();

    return [
        'name' => 'Maker ' . $autoIncrement_makes->current(),
    ];
});

//Sample data seeder for levels table
$factory->define(Level::class, function (Generator $faker) use ($autoIncrement_levels) {
    $autoIncrement_levels->next();

    return [
        'name' => 'Level ' . $autoIncrement_levels->current(),
    ];
});

//Sample data seeder for tags table
$factory->define(Tag::class, function (Generator $faker) use ($autoIncrement_tags) {
    $autoIncrement_tags->next();

    return [
        'name' => 'Tag ' . $autoIncrement_tags->current(),
    ];
});


//Sample data seeder for grade_names table
$factory->define(GradeName::class, function (Generator $faker) use ($autoIncrement_grade_names) {
    $autoIncrement_grade_names->next();
    return [
        'grade_id' => function () {
            return Grade::inRandomOrder()->first()->id;
        },
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'name' => 'Grade ' . $autoIncrement_grade_names->current(),
        'file_id' => 'Temp(file_id grade name)',
    ];
});


//Sample data seeder for chapters table
$factory->define(Chapter::class, function (Generator $faker) use ($autoIncrement_chapters) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    $autoIncrement_chapters->next();
    return [
        'version_id' => function () {
            return Version::inRandomOrder()->first()->id;
        },
        'control_no' => $faker->unique()->taxId(),
        'collection_id' => function () {
            return Collection::inRandomOrder()->first()->id;
        },
        'chapter_no' => $autoIncrement_chapters->current(),
        'folder_id' => 'Temp(folder_id chapter)',
        'file_id' => 'Temp(file_id chapter setting)',
    ];
});

//Sample data seeder for versions table
$factory->define(Version::class, function (Generator $faker) use ($autoIncrement_versions) {
    $autoIncrement_versions->next();
    return [
        'grade_id' => function () {
            return Grade::inRandomOrder()->first()->id;
        },
        'tips_id' => function () {
            return Tips::inRandomOrder()->first()->id;
        },
        'name' => 'Version ' . $autoIncrement_versions->current(),
        'release_date_chapter' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'release_date_small_test' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'chapter_collection_id' => $faker->randomDigit,
        'small_test_id' => $faker->randomDigit,
        'file_id_version' => 'Temp(file_id verions)',
        'folder_id_version' => 'Temp(folder_id version)',
        'file_id_release' => 'Temp(file_id release)',
    ];
});


//Sample for small_tests table
$factory->define(SmallTest::class, function (Generator $faker) use ($autoIncrement_small_tests) {
    $autoIncrement_small_tests->next();
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    return [
        'chapter_id' => function () {
            return Chapter::inRandomOrder()->first()->id;
        },
        'num_issues' => $faker->numberBetween(5, 20),
        'pass_score_rate' => $faker->numberBetween(0, 100),
        'question_format' => $faker->boolean(),
        'option_display_format' => $faker->boolean(),
        'control_no' => $autoIncrement_small_tests->current(),
        'file_id' => 'Temp(file_id small test setting)',
        'folder_id' => 'Temp(folder_id small test)',
    ];
});


//Sample data seeder for card_appearance-rates table
$factory->define(CardAppearanceRate::class, function (Generator $faker) {
    return [
        'collection_id' => function () {
            return Collection::inRandomOrder()->first()->id;
        },
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'level_id' => function () {
            return Level::inRandomOrder()->first()->id;
        },
        'occurrence_rate' => $faker->numberBetween(0, 100),
        'has_gacha' => $faker->boolean()
    ];
});

//Sample data seeder for message_tips table
$factory->define(MessageTips::class, function (Generator $faker) {
    return [
        'tips_id' => function () {
            return Tips::inRandomOrder()->first()->id;
        },
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'passing_message' => $faker->sentence(6, true),
        'failed_message' => $faker->sentence(6, true),
        'correct_message' => $faker->sentence(6, true),
        'incorrect_message' => $faker->sentence(6, true),
        'file_id' => 'Temp(file_id message)',
    ];
});

//Sample data seeder for possession_collection
$factory->define(PossessionCollection::class, function (Generator $faker) {
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'collection_id' => function () {
            return Collection::inRandomOrder()->first()->id;
        },
    ];
});


//Sample data seeder for certificates table
$factory->define(Certificate::class, function (Generator $faker) {
    return [
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
    ];
});


//Sample data seeder for possession_sertificates table
$factory->define(PossessionCertificate::class, function (Generator $faker) {
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'certificate_id' => function () {
            return Certificate::inRandomOrder()->first()->id;
        },
        'issue_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'photo_path' => $faker->imageUrl($width = 225, $height = 300),
    ];
});


//Sample data seeder for announcements table
$factory->define(Announcement::class, function (Generator $faker) use ($autoIncrement_announcements) {
    $autoIncrement_announcements->next();
    return [
        'subject' => '件名 ' . $autoIncrement_announcements->current(),
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'description' => $faker->text(100),
        'area_id' => function () {
            return Area::inRandomOrder()->first()->id;
        },
    ];
});


//Sample data seeder for bookmarks table
$factory->define(Bookmark::class, function (Generator $faker) use ($autoIncrement_bookmarks) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    $autoIncrement_bookmarks->next();
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'control_no' => $autoIncrement_bookmarks->current(),
    ];
});

//Sample data seeder for logs_login table
$factory->define(LogLogin::class, function (Generator $faker) {
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'login_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'model' => $faker->boolean(),
    ];
});


//Sample data seeder for logs_active_time table
$factory->define(LogActiveTime::class, function (Generator $faker) {
    return [
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'start_time' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'end_time' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});

//Sample data seeder for logs_tips table
$factory->define(LogTips::class, function (Generator $faker) {
    return [
        'tips_id' => function () {
            return Tips::inRandomOrder()->first()->id;
        },
        'lesson_log_id' => function () {
            return LogComa::inRandomOrder()->first()->id;
        },
        'small_test_log_id' => function () {
            return LogSmallTest::inRandomOrder()->first()->id;
        },
    ];
});

//Sample data seeder for logs_lession table
$factory->define(LogComa::class, function (Generator $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));

    return [
        'control_no' => $faker->unique()->taxId(),
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'end_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'completion_flg' => $faker->boolean(),
    ];
});

//Sample data seeder for logs_small_test table
$factory->define(LogSmallTest::class, function (Generator $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));

    return [
        'control_no' => $faker->unique()->taxId(),
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'point' => $faker->numberBetween(0, 100),
        'result' => $faker->boolean(),
    ];
});


//Sample data seeder for guides table
$factory->define(Guide::class, function (Generator $faker) {
    return [
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'html_code' => "<h3 style='color: red'>Html code here</h3>",
    ];
});


//Sample data seeder for terms table
$factory->define(Term::class, function (Generator $faker) {
    return [
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'terms_of_use' => $faker->text(),
    ];
});


//Sample data seeder for coma_categories table
$factory->define(ComaCategory::class, function (Generator $faker) use ($autoIncrement_coma_categories) {
    $autoIncrement_coma_categories->next();
    return [
        'frame_category_name' => 'コマカテゴリ ' . $autoIncrement_coma_categories->current(),
    ];
});

//Sample data seeder for comas table
$factory->define(Coma::class, function (Generator $faker) use ($autoIncrement_comas) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));

    $autoIncrement_comas->next();
    return [
        'chapter_id' => function () {
            return Chapter::inRandomOrder()->first()->id;
        },
        'frame_name' => 'コマ ' . $autoIncrement_comas->current(),
        'frame_no' => $autoIncrement_comas->current(),
        'coma_category_id' => function () {
            return ComaCategory::inRandomOrder()->first()->id;
        },
        'file_id' => 'Temp(file_id coma common setting)',
        'folder_id' => 'Temp(folder_id coma)',
        'control_no' => $faker->unique()->taxId(),
    ];
});


//Sample data seeder for chapter_names table
$factory->define(ChapterName::class, function (Generator $faker) use ($autoIncrement_chapters_name) {
    $autoIncrement_chapters_name->next();

    return [
        'chapter_id' => function () {
            return Chapter::inRandomOrder()->first()->id;
        },
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'name' => 'チャプター ' . $autoIncrement_chapters_name->current(),
        'file_id' => 'Temp(filed_id chapter name)',
    ];
});

//Sample data seeder for messages_small_test table
$factory->define(MessageSmallTest::class, function (Generator $faker) {
    return [
        'small_test_id' => function () {
            return SmallTest::inRandomOrder()->first()->id;
        },
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'passing_message' => $faker->text(50),
        'failed_message' => $faker->text(50),
        'correct_message' => $faker->text(50),
        'incorrect_message' => $faker->text(50),
        'file_id' => 'Temp(file_id message)',
    ];
});

//Sample data seeder small_test_questions table
$factory->define(SmallTestQuestion::class, function (Generator $faker) {
    return [
        'small_test_id' => function () {
            return SmallTest::inRandomOrder()->first()->id;
        },
        'title' => $faker->text($maxNbChars = 64),
        'question_format' => $faker->boolean(),
        'score' => $faker->numberBetween(0, 100),
        'file_id' => 'Temp(file_id small test question setting)',
        'folder_id' => 'Temp(folder_id small test question)',
    ];
});


//Sample data seeder small_test_question_choices table
$factory->define(SmallTestQuestionChoice::class, function (Generator $faker) use ($autoIncrement_small_test_question_choices) {
    $autoIncrement_small_test_question_choices->next();
    return [
        'small_test_question_id' => function () {
            return SmallTestQuestion::inRandomOrder()->first()->id;
        },
        'option_description' => $faker->text(50),
        'choice_no' => $autoIncrement_small_test_question_choices->current(),
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'option_value' => $faker->boolean(),
        'image_path' => $faker->imageUrl(225, 300),
        'file_id_explanation' => 'Temp(file_id explanation)',
        'file_id_setting' => 'Temp(file_id options setting)',
        'folder_id' => 'Temp(folder_id options)',
    ];
});


//Sample data seeder for notification_settings table
$factory->define(NotificationSetting::class, function (Generator $faker) {
    return [
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'notification_1_term' => $faker->numberBetween(0, 100),
        'notification_1_setting' => $faker->boolean(),
        'notification_1_description' => $faker->text(30),
        'notification_2_term' => $faker->numberBetween(0, 100),
        'notification_2_description' => $faker->text(30),
        'notification_2_setting' => $faker->boolean(),
        'notification_3_term' => $faker->numberBetween(0, 100),
        'notification_3_description' => $faker->text(30),
        'notification_3_setting' => $faker->boolean(),
        'notification_4_term' => $faker->numberBetween(0, 100),
        'notification_4_description' => $faker->text(30),
        'notification_4_setting' => $faker->boolean(),
    ];
});


//Sample data seeder for logs_big_test table
$factory->define(LogBigTest::class, function (Generator $faker) {
    $faker->addProvider(new Faker\Provider\it_IT\Person($faker));
    return [
        'control_no' => $faker->unique()->taxId(),
        'user_id' => function () {
            return User::inRandomOrder()->first()->id;
        },
        'point' => $faker->numberBetween(0, 100),
        'result' => $faker->boolean(),
    ];
});

//Sample data seeder for messages_big_test table
$factory->define(MessageBigTest::class, function (Generator $faker) {
    return [
        'big_test_id' => function () {
            return BigTest::inRandomOrder()->first()->id;
        },
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'passing_message' => $faker->text(20),
        'failed_message' => $faker->text(20),
        'correct_message' => $faker->text(20),
        'incorrect_message' => $faker->text(20),
        'file_id' => 'Temp(file_id message)',
    ];
});


//Sample data seeder for trophy_settings table
$factory->define(TrophySetting::class, function (Generator $faker) use ($factory) {
    return [
        'big_test_id' => function () {
            return BigTest::inRandomOrder()->first()->id;
        },
        'collection_id' => function () {
            return Collection::inRandomOrder()->first()->id;
        },
        'correct_answer_rate' => $faker->numberBetween(0, 100),
        'folder_id' => 'Temp(folder_id trophy setting)',
        'file_id' => 'Temp(file_id trophy setting)',
    ];
});


//Sample data seeder for messages_trophy_setting table
$factory->define(MessageTrophySetting::class, function (Generator $faker) {
    return [
        'trophy_setting_id' => function () {
            return TrophySetting::inRandomOrder()->first()->id;
        },
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'message' => $faker->text(50),
        'file_id' => 'Temp(file_id message)',
    ];
});


//Sample data seeder for small_test_question_problems table
$factory->define(SmallTestQuestionProblem::class, function (Generator $faker) {
    return [
        'small_test_question_id' => function () {
            return SmallTestQuestion::inRandomOrder()->first()->id;
        },
        'problem_statement' => $faker->text(100),
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'image_path' => $faker->imageUrl(300, 400),
        'priority_check' => $faker->boolean(),
        'file_id' => 'Temp(file_id problem setting)',
        'video_path' => $faker->randomElement($array = array('https://www.youtube.com/watch?v=Q6dsRpVyyWs', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'https://www.youtube.com/watch?v=2idPJMuqhxs')),
    ];
});

//Sample data seeder for coma_languages table
$factory->define(ComaLanguage::class, function (Generator $faker) {
    return [
        'coma_id' => function () {
            return Coma::inRandomOrder()->first()->id;
        },
        'music_path' => 'http://blog.mzsky.cc/data/attachment/music/file/200804/9f85aa2f376391bcc3e080ac914a1ab6.mp3',
        'description' => $faker->text(50),
        'language_id' => function () {
            return Language::inRandomOrder()->first()->id;
        },
        'video_path' => $faker->randomElement($array = array('https://www.youtube.com/watch?v=Q6dsRpVyyWs', 'https://www.youtube.com/watch?v=3WrUd5nl1lI', 'https://www.youtube.com/watch?v=2idPJMuqhxs')),
        'priority_check' => $faker->boolean(),
        'file_id' => 'Temp(file_id coma languages setting)',
        'image_path' => $faker->imageUrl(300, 400),
    ];
});


/**
 * Function auto increment
 * @return \Generator
 */
function autoIncrement_grades()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_collections()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_makes()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_tags()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_grade_names()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_levels()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_chapters()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_versions()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_small_tests()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_announcements()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_bookmarks()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_coma_categories()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_comas()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_chapters_name()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_small_test_question_choices()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

function autoIncrement_trophy_ranks()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}

