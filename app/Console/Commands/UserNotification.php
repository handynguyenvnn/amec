<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Users;

class UserNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push_notification:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push notification to user for a period of time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = new Users();
        $users->userPushNotification();
    }
}
