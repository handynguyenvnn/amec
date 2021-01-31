<?php

//use App\Models\Account;
use App\Models\Ad;
use App\Models\AdministratorTransmissionHistory;
use App\Models\AdVideo;
use App\Models\Announcement;
use App\Models\Area;
use App\Models\Authority;
use App\Models\BigTest;
use App\Models\Bookmark;
use App\Models\CardAppearanceRate;
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
use App\Models\PossessionAuthority;
use App\Models\PossessionCertificate;
use App\Models\PossessionCollection;
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
use App\Models\User;
use App\Models\UserTransmissionHistory;
use App\Models\Version;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(LanguagesTableSeeder::class);
        $this->call(ProfessionsTableSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(CartalystSentinelSeeder::class);

        factory(User::class, 100)->create();
        factory(ChatTool::class, 50)->create();
        factory(UserTransmissionHistory::class, 100)->create();
        factory(AdministratorTransmissionHistory::class, 20)->create();
        factory(Project::class, 20)->create();
        factory(Grade::class, 20)->create();
        factory(MyBackgroundPage::class, 100)->create();
        factory(Tips::class, 50)->create();
        factory(Maker::class, 10)->create();
        factory(Level::class, 100)->create();
        factory(Tag::class, 200)->create();
        factory(TrophyRank::class, 50)->create();
        factory(Collection::class, 100)->create();
        factory(BigTest::class, 10)->create();

        factory(GradeName::class, 100)->create();
        factory(Version::class, 100)->create();
        factory(Chapter::class, 50)->create();
        factory(SmallTest::class, 100)->create();
        //factory(Account::class, 50)->create();
        //factory(Authority::class, 9)->create();
        //factory(PossessionAuthority::class, 100)->create();

        factory(Ad::class, 10)->create();
        factory(AdVideo::class, 20)->create();

        factory(CardAppearanceRate::class, 100)->create();

        factory(MessageTips::class, 20)->create();
        factory(PossessionCollection::class, 50)->create();

        factory(Certificate::class, 100)->create();
        factory(PossessionCertificate::class, 100)->create();
        factory(Announcement::class, 50)->create();
        factory(Bookmark::class, 100)->create();
        factory(LogLogin::class, 100)->create();
        factory(LogActiveTime::class, 100)->create();
        factory(LogSmallTest::class, 100)->create();
        factory(LogComa::class, 100)->create();
        factory(LogTips::class, 100)->create();

        factory(Guide::class, 50)->create();
        factory(Term::class, 10)->create();
        factory(ComaCategory::class, 50)->create();

        factory(Coma::class, 100)->create();
        factory(ChapterName::class, 30)->create();
        factory(MessageSmallTest::class, 100)->create();
        factory(SmallTestQuestion::class, 100)->create();
        factory(SmallTestQuestionChoice::class, 100)->create();
        factory(NotificationSetting::class, 20)->create();

        factory(LogBigTest::class, 100)->create();
        factory(MessageBigTest::class, 100)->create();

        factory(TrophySetting::class, 100)->create();
        factory(MessageTrophySetting::class, 50)->create();

        factory(SmallTestQuestionProblem::class, 50)->create();
        factory(ComaLanguage::class, 100)->create();
    }
}
