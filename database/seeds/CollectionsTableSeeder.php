<?php

use Illuminate\Database\Seeder;

class CollectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collections = [
            [
                'id' => 1,
                'name' => 'カード1',
                'maker_id' => 1,
                'language_id' => 1,
                'level_id' => 1,
                'description' => '説明1',
                'image_path' => 'img/no-image.png',
                'tag_id' => 1,
                'collection_no' => 1,
                'type_id' => 1,
                'youtube_link' => 'https://www.youtube.com',
                'grade_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'パーツ1',
                'maker_id' => 2,
                'language_id' => 2,
                'level_id' => 2,
                'description' => '説明2',
                'image_path' => 'img/no-image.png',
                'tag_id' => 2,
                'collection_no' => 2,
                'type_id' => 2,
                'youtube_link' => 'https://www.youtube.com',
                'grade_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'トロフィー1',
                'maker_id' => 3,
                'language_id' => 3,
                'level_id' => 3,
                'description' => '説明3',
                'image_path' => 'img/no-image.png',
                'tag_id' => 3,
                'collection_no' => 3,
                'type_id' => 3,
                'youtube_link' => 'https://www.youtube.com',
                'grade_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];
        DB::table('collections')->insert($collections);
    }
}
