<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/items.csv');
        $delimitor = ',';

        Item::truncate();

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

                    $obj = new Item;

                    $obj->id = $row[0];
                    $obj->id_categoria = $row[1];
                    $obj->texto_item = $row[2];
                    $obj->created_at = $row[3];
                    $obj->updated_at = $row[4];
                    $obj->save();
                }
            }
            fclose($handle);
        }
    }
}
