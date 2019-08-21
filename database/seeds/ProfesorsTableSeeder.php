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
                    $seed->nivel = $row[2];
                    $seed->created_at = $row[3];
                    $seed->updated_at = $row[4];
                    $seed->id_user = $row[5];

                    $seed->save();
                    echo var_dump($row);
                }
            }
            fclose($handle);
        }
    }
}
