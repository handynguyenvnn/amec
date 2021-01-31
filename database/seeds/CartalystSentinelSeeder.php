<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class CartalystSentinelSeeder extends Seeder

{
    private $mappingPermissions = [
        'account_management' => 'account.admin',
        'master_management' => 'master.admin',
        'access_management' => 'access_analysis.admin',
        'content_management' => 'content.admin',
        'collection_management' => 'collection.admin',
        'user_management' => 'user.admin',
        'notification' => 'notification.admin',
        'terms_of_service' => 'terms_of_service.admin',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoles();
        $this->createRolePermissions();
        $this->createAccounts();
    }

    /**
     * Create user roles
     */
    private function createRoles()
    {
        DB::table("roles")->insert(
            [
                ["slug" => 'account_management', "name" => 'アカウント管理', "permissions" => '', "created_at" => Carbon::now()],
                ["slug" => 'master_management', "name" => 'マスター管理', "permissions" => '', "created_at" => Carbon::now()],
                ["slug" => 'access_management', "name" => 'ユーザ管理', "permissions" => '', "created_at" => Carbon::now()],
                ["slug" => 'content_management', "name" => 'コンテンツ管理', "permissions" => '', "created_at" => Carbon::now()],
                ["slug" => 'collection_management', "name" => 'コレクション管理', "permissions" => '', "created_at" => Carbon::now()],
                ["slug" => 'user_management', "name" => 'ユーザ管理', "permissions" => '', "created_at" => Carbon::now()],
                ["slug" => 'notification', "name" => 'お知らせ', "permissions" => '', "created_at" => Carbon::now()],
                ["slug" => 'terms_of_service', "name" => '利用規約', "permissions" => '', "created_at" => Carbon::now()]
            ]
        );
    }

    private function createAccounts()
    {
        $credentials = ['name' => '管理者', 'login_id' => 'admin', 'is_master' => '1', 'password' => '$2y$10$ZTOk97twzQgsyF0OxzG17.eT7bsT.vG4gFpzHvZ/9oxVHj/T4bl5i'];
        $this->setAccount($credentials, ['account_management', 'master_management', 'access_management', 'content_management', 'collection_management', 'user_management', 'notification', 'terms_of_service']);

        $credentials = ['name' => 'Account Manager 01', 'login_id' => 'accountM01',];
        $this->setAccount($credentials, 'account_management');

        $credentials = ['name' => 'Master Manager 01', 'login_id' => 'masterM01',];
        $this->setAccount($credentials, 'master_management');

        $credentials = ['name' => 'Access Analysis 01', 'login_id' => 'accessM01',];
        $this->setAccount($credentials, 'access_management');

        $credentials = ['name' => 'Content Manager 01', 'login_id' => 'contentM01',];
        $this->setAccount($credentials, 'content_management');

        $credentials = ['name' => 'Collection Manager 01', 'login_id' => 'collectionM01',];
        $this->setAccount($credentials, 'collection_management');

        $credentials = ['name' => 'User Manager 01', 'login_id' => 'userM01',];
        $this->setAccount($credentials, 'user_management');

        $credentials = ['name' => 'Notification 01', 'login_id' => 'notificationM01',];
        $this->setAccount($credentials, 'notification');

        $credentials = ['name' => 'Terms of service 01', 'login_id' => 'termsM01',];
        $this->setAccount($credentials, 'terms_of_service');

        $credentials = ['name' => 'Common Account 01', 'login_id' => 'commonM01',];
        $this->setAccount($credentials, ['account_management', 'master_management', 'access_management', 'content_management', 'collection_management', 'user_management', 'notification', 'terms_of_service']);
    }

    private function setAccount(array $credentials, $types = 'account_management')
    {
        $extra = [
            'password' => '12345',
            'lock' => false,
            'login_miss_times' => 0
        ];
        $user = Sentinel::registerAndActivate(array_merge($credentials, $extra));
        $permissions = [];
        if (is_array($types)) {
            foreach ($types as $type) {
                $role = Sentinel::findRoleBySlug($type);
                $role->users()->attach($user);
                $permissions[$this->mappingPermissions[$type]] = true;
            }
        } else {
            $permissions[$this->mappingPermissions[$types]] = true;
            $role = Sentinel::findRoleBySlug($types);
            $role->users()->attach($user);
        }
        $user->permissions = $permissions;
        $user->save();

    }

    private function createRolePermissions()
    {
        $this->setRolePermission($this->mappingPermissions['account_management'], 'account_management');
        $this->setRolePermission($this->mappingPermissions['master_management'], 'master_management');
        $this->setRolePermission($this->mappingPermissions['access_management'], 'access_management');
        $this->setRolePermission($this->mappingPermissions['content_management'], 'content_management');
        $this->setRolePermission($this->mappingPermissions['collection_management'], 'collection_management');
        $this->setRolePermission($this->mappingPermissions['user_management'], 'user_management');
        $this->setRolePermission($this->mappingPermissions['notification'], 'notification');
        $this->setRolePermission($this->mappingPermissions['terms_of_service'], 'terms_of_service');
    }

    private function setRolePermission($permission, $role = 'account_management')
    {
        $role = Sentinel::findRoleBySlug($role);
        $role->permissions = [$permission];
        $role->save();
    }
}
