<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            [
                'area' => '日本',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'area' => '英国',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'area' => 'ベトナム',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];

        DB::table('areas')->insert($areas);
    }
}

