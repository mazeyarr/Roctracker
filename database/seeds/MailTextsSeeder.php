<?php

use Illuminate\Database\Seeder;
use App\MailTexts;
use App\ScheduleEmailTasks;

class MailTextsSeeder extends Seeder
{
    public $string = "Lorem Ipsum is slechts een proeftekst uit het drukkerij- en zetterijwezen. Lorem Ipsum is de standaard proeftekst in deze bedrijfstak sinds de 16e eeuw, toen een onbekende drukker een zethaak met letters nam en ze door elkaar husselde om een font-catalogus te maken. Het heeft niet alleen vijf eeuwen overleefd maar is ook, vrijwel onveranderd, overgenomen in elektronische letterzetting. Het is in de jaren '60 populair geworden met de introductie van Letraset vellen met Lorem Ipsum passages en meer recentelijk door desktop publishing software zoals Aldus PageMaker die versies van Lorem Ipsum bevatten.";
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ScheduleEmailTasks::create(array(
            'table' => 'teamleaders',
            'to' => json_encode(array()),
            'fk_mail_texts' => MailTexts::create(array(
                'name' => 'Signaal Teamleiders',
                'title' => 'Assessoren aantal laag',
                'subject' => 'Assessoren gedaald',
                'text' => $this->string,
                'type' => 'success',
            ))->id
        ));

        ScheduleEmailTasks::create(array(
            'table' => 'teamleaders',
            'to' => json_encode(array()),
            'fk_mail_texts' => MailTexts::create(array(
                'name' => 'Signaal Administratie',
                'title' => 'Waarschuwing: Geld tekort',
                'subject' => 'Geld binnen het college',
                'text' => $this->string,
                'type' => 'warning',
            ))->id
        ));

        ScheduleEmailTasks::create(array(
            'table' => 'assessors',
            'to' => json_encode(array()),
            'fk_mail_texts' => MailTexts::create(array(
                'name' => 'Info mail Assessoren',
                'title' => 'Basistraining ?',
                'subject' => 'Aanmelding Assessors Course',
                'text' => $this->string,
                'type' => 'info',
            ))->id
        ));

        ScheduleEmailTasks::create(array(
            'table' => 'teamleaders',
            'to' => json_encode(array()),
            'fk_mail_texts' => MailTexts::create(array(
                'name' => 'Teamleiders Dringende Waarschuwing',
                'title' => 'Waarschuwing Assessor Aaantal',
                'subject' => 'Aantal Assessors in College te laag !',
                'text' => $this->string,
                'type' => 'error',
            ))->id
        ));
    }
}
