<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

        /** Dev Seeders */
        /*$this->call(TeamleadersTableSeeder::class);
        $this->call(CollegeTableSeeder::class);
        $this->call(TeamleadersInCollegeTableSeeder::class);
        $this->call(AssessorTableSeeder::class);
        $this->call(HistoryDataSeeder::class);*/
        /*$this->call(MaintenancesTableSeeder::class);*/

        /** Demo Seeders */
        $this->call(SeedDemoContent::class);
    }
}
