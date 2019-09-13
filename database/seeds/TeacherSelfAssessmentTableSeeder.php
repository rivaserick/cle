<?php

use Illuminate\Database\Seeder;

class TeacherSelfAssessmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/teacher_self_assessments.csv');
        $delimitor = ',';

        Teacher_selfassessment::truncate();

        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $header = null;
        $row = null;

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimitor)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    
                    //id,id_categoria,texto_item,created_at,updated_at

                    $obj = new Teacher_selfassessment;

                    $obj->id = $row[0];
                    $obj->texto = $row[1];
                    $obj->ruta_imagen = $row[2];
                    $obj->created_at = $row[3];
                    $obj->updated_at = $row[4];
                    $obj->save();
                }
            }
            fclose($handle);
        }
    }
}
