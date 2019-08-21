<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = base_path('database/seeders/users.csv');
        $delimitor=',';

        User::truncate();

        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimitor)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    // id,name,email,email_verified_at,password,remember_token,created_at,updated_at,username,password_changed
                    User::create([
                        'id' => $row[0],
                        'name' => $row[1],
                        'email' => $row[2],
                        'password' => $row[4],
                        'updated_at' => $row[7],
                        'username' => $row[8],
                        'password_changed' => $row[9],
                    ]);
                }
            }
            fclose($handle);
        }

        return $data;
    }
}
