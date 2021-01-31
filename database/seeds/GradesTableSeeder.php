<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'project_id' => rand(1, 10),
                'grade_no' => 1,
                'content_type' => 1,
                'folder_id' => 1,
                'file_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        DB::table('grades')->insert($users);
    }
}
