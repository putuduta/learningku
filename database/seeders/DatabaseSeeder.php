<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
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
            RoleSeeder::class,
            UserSeeder::class,
            SchoolYearSeeder::class,
            ClassSeeder::class,
            MaterialSeeder::class,
            AttendanceSeeder::class,
            AssignmentSeeder::class,
            ForumSeeder::class,
            ReplyForumSeeder::class,
            ScoreSeeder::class
        ]);
    }
}
