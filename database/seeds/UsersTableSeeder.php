<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'password' => password_hash('12345', PASSWORD_BCRYPT),
                'language_id' => 1,
                'username' => 'user_' . ($i + 1),
                'email' => $faker->email,
                'gender' => rand(0, 1),
                'birth_date' => $faker->date('Y-m-d'),
                'area_id' => rand(1, 10),
                'profession_id' => rand(1, 10),
                'address' => $faker->address,
                'phone' => $faker->tollFreePhoneNumber,
                'registration_date' => $faker->dateTimeBetween('-10year'),
                'last_login_date' => $faker->dateTimeThisMonth,
                'notification_setting_1' => 1,
                'notification_setting_2' => 1,
                'notification_setting_3' => 1,
                'contents' => $faker->text(),
                'sns_public_setting' => 1,
                'device_id' => $faker->uuid,
                'firebase_token' => '',
                'user_photo' => '',
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        DB::table('users')->insert($users);
    }
}
