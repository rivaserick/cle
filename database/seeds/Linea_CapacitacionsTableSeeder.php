<?php

use App\LineaCapacitacion;
use Illuminate\Database\Seeder;

class Linea_CapacitacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/linea_capacitacions.csv');
        $delimitor = ',';

        LineaCapacitacion::truncate();

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
                    $linea = new LineaCapacitacion;

                    $linea->id = $row[0];
                    $linea->nombre = $row[1];
                    $linea->created_at = $row[2];
                    $linea->updated_at = $row[3];
                    $linea->save();
                    echo var_dump($row);
                }
            }
            fclose($handle);
        }
    }
}
