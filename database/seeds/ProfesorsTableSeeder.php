<?php

use App\Profesor;
use Illuminate\Database\Seeder;

class ProfesorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/profesores.csv');
        $delimitor = ',';

        Profesor::truncate();

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

                    $seed = new Profesor; // id,nombre,nivel,created_at,updated_at,id_user

                    $seed->id = $row[0];
                    $seed->nombre = $row[1];
                    $seed->created_at = now();
                    $seed->updated_at = now();
                    $seed->username = $row[4];
                    $seed->password = $row[5];
                    $seed->original_password = $row[6];
                    $seed->save();
                }
            }
            fclose($handle);
        }
    }
}
