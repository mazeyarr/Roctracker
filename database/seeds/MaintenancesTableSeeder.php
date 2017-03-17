<?php

use Illuminate\Database\Seeder;
use App\Maintenance;
use Carbon\Carbon;
use App\Log;

class MaintenancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dateid = Maintenance::create(array(
            'institution' => 'Test 1',
            'location' => 'ROC Ter AA',
            'days' => 1,
            'from' => Carbon::now()->setDate(2017, 3, 22)->toDateTimeString(),
            'till' => Carbon::now()->setDate(2017, 3, 22)->toDateTimeString(),
            'year' => date('Y'),
        ));
        $groupid = \App\MaintenanceGroups::create(array(
            'title' => "Groep " . Log::generateRandomString(5),
            'participants' => '{"participants": [1,2,3]}',
            'year' => date('Y'),
            'fk_maintenances' => $dateid->id
        ));

        $dateid = Maintenance::create(array(
            'institution' => 'Test 2',
            'location' => 'ROC Ter AA',
            'days' => 1,
            'from' => Carbon::now()->setDate(2017, 3, 23)->toDateTimeString(),
            'till' => Carbon::now()->setDate(2017, 3, 23)->toDateTimeString(),
            'year' => date('Y'),
        ));
        $groupid = \App\MaintenanceGroups::create(array(
            'title' => "Groep " . Log::generateRandomString(5),
            'participants' => '{"participants": []}',
            'year' => date('Y'),
            'fk_maintenances' => $dateid->id
        ));

        $dateid = Maintenance::create(array(
            'institution' => 'Test 3',
            'location' => 'ROC Ter AA',
            'days' => 1,
            'from' => Carbon::now()->setDate(2017, 3, 24)->toDateTimeString(),
            'till' => Carbon::now()->setDate(2017, 3, 24)->toDateTimeString(),
            'year' => date('Y'),
        ));
        $groupid = \App\MaintenanceGroups::create(array(
            'title' => "Groep " . Log::generateRandomString(5),
            'participants' => '{"participants": []}',
            'year' => date('Y'),
            'fk_maintenances' => $dateid->id
        ));

        $dateid = Maintenance::create(array(
            'institution' => 'Test 4',
            'location' => 'ROC Ter AA',
            'days' => 1,
            'from' => Carbon::now()->setDate(2017, 3, 25)->toDateTimeString(),
            'till' => Carbon::now()->setDate(2017, 3, 25)->toDateTimeString(),
            'year' => date('Y'),
        ));
        $groupid = \App\MaintenanceGroups::create(array(
            'title' => "Groep " . Log::generateRandomString(5),
            'participants' => '{"participants": []}',
            'year' => date('Y'),
            'fk_maintenances' => $dateid->id
        ));
    }
}
