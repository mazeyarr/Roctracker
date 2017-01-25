<?php

use Illuminate\Database\Seeder;
use App\Assessors;
use Carbon\Carbon;

class AssessorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assessors::create(array(
            'name' => 'Rico van Dooren',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Dick van Kalsbeek',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Casper de Meer',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Achmed Hakabi',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Sophie van de Steeg',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Lisa Richards',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Lieke Velds',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Zijlstra Openheimer',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Richard van de Sar',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Zara Larson',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Wijnans Robberts',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Margo Hendrikx',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Mieke Liebrechts',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Michelle van Doordrecht',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Anna Robin',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Jannie Liekenhof',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Koos Filipono',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Jolanda de Haas',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Dione Stax',
            'fk_college' => 1,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Fenne van Koophaven',
            'fk_college' => 1,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Bart Verstappen',
            'fk_college' => 1,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Mia Koblava',
            'fk_college' => 1,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Alia van Kempen',
            'fk_college' => null,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'status' => 1,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Richard van Kloppings',
            'fk_college' => 6,
            'team' => 'D&R',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 0,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Miera Shouwers',
            'fk_college' => 6,
            'team' => 'D&R',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'status' => 0,
            'log' => '{}'
        ));
    }
}
