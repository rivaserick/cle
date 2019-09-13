<?php

use App\Observador;
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
        //$filename = base_path('database/seeders/coordinadors.csv');
        //$delimitor = ',';

        Observador::truncate();

        /*if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }
        $header = null;
        $row = null;

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimitor)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {*/

                    $seed = new Observador; //

                    $seed->nombre = 'Juan Perez';
                    $seed->username = 'juanperez';
                    $seed->password = bcrypt('observador');
                    $seed->original_password = bcrypt('observador');

                    $seed->save();
          /*          echo var_dump($row);
                }
            }
            fclose($handle);
        }*/
    }
}
