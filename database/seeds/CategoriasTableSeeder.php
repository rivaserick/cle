<?php

use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/categorias.csv');
        $delimitor = ',';

        Categoria::truncate();

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

                    //id,nombre_categoria,created_at,updated_at

                    $linea = new Categoria;

                    $linea->id = $row[0];
                    $linea->nombre_categoria = $row[1];
                    $linea->created_at = $row[2];
                    $linea->updated_at = $row[3];
                    $linea->save();
                }
            }
            fclose($handle);
        }
    }
}
