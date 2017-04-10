<?php

use Illuminate\Database\Seeder;
use App\MailTexts;

class MailTextsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailTexts::create(array(
            'name' => 'name-1',
            'title' => 'Test - success',
            'subject' => '1',
            'text' => '',
            'type' => 'success',
        ));
        MailTexts::create(array(
            'name' => 'name-2',
            'title' => 'Test - warning',
            'subject' => '2',
            'text' => '',
            'type' => 'warning',
        ));
        MailTexts::create(array(
            'name' => 'name-3',
            'title' => 'Test - info',
            'subject' => '3',
            'text' => '',
            'type' => 'info',
        ));
        MailTexts::create(array(
            'name' => 'name-4',
            'title' => 'Test - Error',
            'subject' => '4',
            'text' => '',
            'type' => 'error',
        ));
    }
}
