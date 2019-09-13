<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            //UsersTableSeeder::class,
            ProfesorsTableSeeder::class,
            CoordinadorsTableSeeder::class,
            ObservadorsTableSeeder::class,
            PeriodsTableSeeder::class,
            StatusesTableSeeder::class,
            Linea_CapacitacionsTableSeeder::class,
            Sublinea_CapacitacionsTableSeeder::class,
            CategoriasTableSeeder::class,
            ItemsTableSeeder::class,
            TeacherSelfAssessmentTableSeeder::class,
            GruposTableSeeder::class,
            ]);
    }
}
