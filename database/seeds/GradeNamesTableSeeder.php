<?php

use Illuminate\Database\Seeder;

class GradeNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gradeNames = [];
        for ($i = 0; $i < 10; $i++) {
            $gradeNames[] = [
                'grade_id' => $i + 1,
                'language_id' => 1,
                'name' => "Grade Name ".($i + 1).' Lang JA',
                'file_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $gradeNames[] = [
                'grade_id' => $i + 1,
                'language_id' => 2,
                'name' => "Grade Name ".($i + 1).' Lang EN',
                'file_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $gradeNames[] = [
                'grade_id' => $i + 1,
                'language_id' => 3,
                'name' => "Grade Name ".($i + 1).' Lang VI',
                'file_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        DB::table('grade_names')->insert($gradeNames);
    }
}
