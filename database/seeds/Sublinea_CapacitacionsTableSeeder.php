<?php

use App\SublineaCapacitacion;
use Illuminate\Database\Seeder;

class Sublinea_CapacitacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/sublinea_capacitacions.csv');
        $delimitor = ',';

        SublineaCapacitacion::truncate();

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
                    $seed = new SublineaCapacitacion;

                    $seed->id = $row[0];
                    $seed->created_at = $row[1];
                    $seed->updated_at = $row[2];
                    $seed->nombre = $row[3];
                    $seed->id_linea_capacitacion = $row[4];
                    $seed->save();
                    echo var_dump($row);
                }
            }
            fclose($handle);
        }
    }
}
