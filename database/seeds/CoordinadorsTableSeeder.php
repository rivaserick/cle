<?php

use App\Coordinador;
use Illuminate\Database\Seeder;

class CoordinadorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/coordinadors.csv');
        $delimitor = ',';

        Coordinador::truncate();

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

                    $seed = new Coordinador; //

                    $seed->id = $row[0];
                    $seed->id_user = $row[1];
                    $seed->created_at = $row[2];
                    $seed->updated_at = $row[3];

                    $seed->save();
                    echo var_dump($row);
                }
            }
            fclose($handle);
        }
    }
}
