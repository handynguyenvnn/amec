<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'lang' => '日本語',
                'lang_code' => 'ja',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lang' => '英語',
                'lang_code' => 'en',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'lang' => 'ベトナム語',
                'lang_code' => 'vi',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        DB::table('languages')->insert($languages);
    }
}
