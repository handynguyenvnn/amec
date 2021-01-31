<?php

use Illuminate\Database\Seeder;

class ProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $professions = [
            [
                'profession' => '公務員',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'profession' => '経営者・役員',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'profession' => '会社員',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'profession' => '自営業',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'profession' => '自由業',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'profession' => '専業主婦',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'profession' => 'パート・アルバイト',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'profession' => '学生',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'profession' => 'その他',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        DB::table('professions')->insert($professions);
    }
}
