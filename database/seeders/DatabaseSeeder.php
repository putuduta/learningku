<?php

namespace Database\Seeders;

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
            // InstitutionSeeder::class,
            // RoleSeeder::class,
            UserSeeder::class,
            ClassSeeder::class,
            ScoreSeeder::class,
            MaterialSeeder::class,
            AttendanceSeeder::class,
            AssignmentSeeder::class,
            RequestClassSeeder::class,
            ThreadSeeder::class,
        ]);
    }
}
