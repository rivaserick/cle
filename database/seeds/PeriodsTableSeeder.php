<?php

use App\Period;
use Illuminate\Database\Seeder;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/periods.csv');
        $delimitor = ',';

        Period::truncate();

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
                    $seed = new Period;

                    $seed->id = $row[0];
                    $seed->nombre = $row[1];
                    $seed->descripcion = $row[2];
                    $seed->fecha_inicio = $row[3];
                    $seed->fecha_fin = $row[4];
                    $seed->created_at = $row[5];
                    $seed->updated_at = $row[6];
                    $seed->vigente = $row[7];
                    $seed->save();
                    echo var_dump($row);
                }
            }
            fclose($handle);
        }
    }
}
