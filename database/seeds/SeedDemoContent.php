<?php

use App\Assessors;
use App\College;
use App\Exams;
use App\HistoryData;
use App\Teamleaders;
use App\TiC;
use App\Constructors;
use Illuminate\Database\Seeder;

class SeedDemoContent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # 1
        $teamleader = new Teamleaders();
        $teamleader->name = "Yvon Pas";
        $teamleader->log = "{}";
        $teamleader->team = "";
        $teamleader->status = 1;
        $teamleader->save();

        $college = new College();
        $college->name = "Presta";
        $college->location = "";
        $college->team = "";
        $college->log = "{}";
        $college->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college->id;
        $tic->save();
        # END

        # 2
        $teamleader = new Teamleaders();
        $teamleader->name = "Wil Hurkmans";
        $teamleader->log = "{}";
        $teamleader->team = "";
        $teamleader->status = 1;
        $teamleader->save();

        $college = new College();
        $college->name = "Bouw & design college";
        $college->location = "";
        $college->team = "";
        $college->log = "{}";
        $college->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college->id;
        $tic->save();
        # END

        # 3
        $teamleader = new Teamleaders();
        $teamleader->name = "Toine Ketelaars";
        $teamleader->log = "{}";
        $teamleader->team = "";
        $teamleader->status = 1;
        $teamleader->save();

        $college = new College();
        $college->name = "Business college";
        $college->location = "";
        $college->team = "";
        $college->log = "{}";
        $college->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college->id;
        $tic->save();
        # END

        # 4
        $teamleader = new Teamleaders();
        $teamleader->name = "Mark van Knegsel";
        $teamleader->log = "{}";
        $teamleader->team = "";
        $teamleader->status = 1;
        $teamleader->save();

        $college = new College();
        $college->name = "Dienstverlening";
        $college->location = "";
        $college->team = "";
        $college->log = "{}";
        $college->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college->id;
        $tic->save();
        # END

        # 4
        $teamleader = new Teamleaders();
        $teamleader->name = "Niels van Dalsen";
        $teamleader->log = "{}";
        $teamleader->team = "";
        $teamleader->status = 1;
        $teamleader->save();

        $college = new College();
        $college->name = "Zorg en welzijn college";
        $college->location = "";
        $college->team = "";
        $college->log = "{}";
        $college->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college->id;
        $tic->save();
        # END

        # 4
        $teamleader = new Teamleaders();
        $teamleader->name = "Peter de Roy van Zuijdewijn";
        $teamleader->log = "{}";
        $teamleader->team = "";
        $teamleader->status = 1;
        $teamleader->save();

        $college = new College();
        $college->name = "Onderwijs & Kinderopvang College";
        $college->location = "";
        $college->team = "";
        $college->log = "{}";
        $college->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college->id;
        $tic->save();
        # END

        # 4
        $teamleader = new Teamleaders();
        $teamleader->name = "Richard Meulenberg";
        $teamleader->log = "{}";
        $teamleader->team = "";
        $teamleader->status = 1;
        $teamleader->save();

        $college1 = new College();
        $college1->name = "ict college";
        $college1->location = "";
        $college1->team = "";
        $college1->log = "{}";
        $college1->save();

        $college2 = new College();
        $college2->name = "Onderwijs Centraal";
        $college2->location = "";
        $college2->team = "";
        $college2->log = "{}";
        $college2->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college1->id;
        $tic->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college2->id;
        $tic->save();
        # END

        # 4
        $teamleader = new Teamleaders();
        $teamleader->name = "Kees Dings";
        $teamleader->log = "{}";
        $teamleader->team = "";
        $teamleader->status = 1;
        $teamleader->save();

        $college = new College();
        $college->name = "Techniek & technologie college";
        $college->location = "";
        $college->team = "";
        $college->log = "{}";
        $college->save();

        $tic = new TiC();
        $tic->fk_teamleader = $teamleader->id;
        $tic->fk_college = $college->id;
        $tic->save();
        # END

        /** FROM HERE INPUT ASSESSORS */

        # Christien Heesters
        $assessor = new Assessors();
        $assessor->name = "Christien Heesters";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "Educatie";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "11/22/1959")->toDateString();
        $assessor->function = "Instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Eveline Sijmons
        $assessor = new Assessors();
        $assessor->name = "Eveline Sijmons";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Bureau markt";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "20/05/1968")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Leon Staal
        $assessor = new Assessors();
        $assessor->name = "Leon Staal";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "Bureau markt";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "11/10/1956")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Maarten Heesters
        $assessor = new Assessors();
        $assessor->name = "Maarten Heesters";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "Bureau markt";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "03/10/1957")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Marga Gijsbers
        $assessor = new Assessors();
        $assessor->name = "Marga Gijsbers";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Educatie";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "21/03/1958")->toDateString();
        $assessor->function = "Teamleider";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Petra Heeskens
        $assessor = new Assessors();
        $assessor->name = "Petra Heeskens";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Educatie";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "07/11/1964")->toDateString();
        $assessor->function = "Instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Stanny Buddingh
        $assessor = new Assessors();
        $assessor->name = "Stanny Buddingh";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Volwassenonderwijs";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "30/11/1955")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Tine van de Velde
        $assessor = new Assessors();
        $assessor->name = "Tine van de Velde";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "He/KO";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "09/09/1954")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Thom Bloks
        $assessor = new Assessors();
        $assessor->name = "Thom Bloks";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 4, "01-02-2012", "02-02-2012");
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "24/08/1955")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Peter Christians
        $assessor = new Assessors();
        $assessor->name = "Peter Christians";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Bouw & design college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Wil Hurkmans")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "Bouw";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "17/01/1956")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Renee van de Kerkhof
        $assessor = new Assessors();
        $assessor->name = "Renee van de Kerkhof";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Bouw & design college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Wil Hurkmans")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Bouw";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "13/07/1965")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Victor van Loon
        $assessor = new Assessors();
        $assessor->name = "Victor van Loon";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Bouw & design college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Wil Hurkmans")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 4, "01-02-2012", "02-02-2012");
        $assessor->team = "Bouw";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "11/10/1952")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Fatima Gazuani Serbout
        $assessor = new Assessors();
        $assessor->name = "Fatima Gazuani Serbout";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "20/01/1970")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Francien Mesman
        $assessor = new Assessors();
        $assessor->name = "Francien Mesman";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "JSMC";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "21/04/1956")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Frans Hikspoors
        $assessor = new Assessors();
        $assessor->name = "Francien Mesman";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "09/01/1954")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Greetje Lathouwers
        $assessor = new Assessors();
        $assessor->name = "Greetje Lathouwers";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "26/10/1958")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Heidi Veltkamp
        $assessor = new Assessors();
        $assessor->name = "Heidi Veltkamp";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "JSMC";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "08/03/1973")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Koen Verheijen
        $assessor = new Assessors();
        $assessor->name = "Koen Verheijen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "JSMC";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "01/16/1986")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Lissete Stoter
        $assessor = new Assessors();
        $assessor->name = "Lissete Stoter";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "4/10/1969")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Marcel Rejinders
        $assessor = new Assessors();
        $assessor->name = "Marcel Rejinders";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "19/09/1967")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Maurice Backus
        $assessor = new Assessors();
        $assessor->name = "Maurice Backus";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "11/08/1973")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Mike van Lierop
        $assessor = new Assessors();
        $assessor->name = "Mike van Lierop";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "28/04/1965")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Miranda Habraken
        $assessor = new Assessors();
        $assessor->name = "Miranda Habraken";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "12/21/1969")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Renee Teeuwsen
        $assessor = new Assessors();
        $assessor->name = "Renee Teeuwsen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 4, "01-02-2012", "02-02-2012");
        $assessor->team = "JSMC";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "13/01/1964")->toDateString();
        $assessor->function = "Instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Rita Jansen
        $assessor = new Assessors();
        $assessor->name = "Rita Jansen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "07/10/1955")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Roelof Oosterwijk
        $assessor = new Assessors();
        $assessor->name = "Roelof Oosterwijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "JSMC";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "24/06/1953")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Twan van Grunsven
        $assessor = new Assessors();
        $assessor->name = "Roelof Oosterwijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "JSMC";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "9/3/1975")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Yvonne Wilbers
        $assessor = new Assessors();
        $assessor->name = "Roelof Oosterwijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AD";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "02/09/1958")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Roelof Oosterwijk
        $assessor = new Assessors();
        $assessor->name = "Roelof Oosterwijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AKA";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "06/09/1955")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Roelof Oosterwijk
        $assessor = new Assessors();
        $assessor->name = "Roelof Oosterwijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AKA";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "06/09/1955")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Jeske Dijkshoorn-Gans
        $assessor = new Assessors();
        $assessor->name = "Jeske Dijkshoorn-Gans";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AKA";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "02/04/1978")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Norbert Sleutjes
        $assessor = new Assessors();
        $assessor->name = "Norbert Sleutjes";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AKA";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "20/11/1960")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Saskia Lemlijn
        $assessor = new Assessors();
        $assessor->name = "Saskia Lemlijn";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AKA";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "28/05/1975")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Sita El Maach
        $assessor = new Assessors();
        $assessor->name = "Sita El Maach";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "AKA";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "10/05/1983")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Carlijn v Renswoude
        $assessor = new Assessors();
        $assessor->name = "Carlijn v Renswoude";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Geüniformeerde beroepen";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "6/29/1981")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Salem El Maach
        $assessor = new Assessors();
        $assessor->name = "Salem El Maach";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Geüniformeerde beroepen";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "24/01/1985")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Anneke der Kinderen
        $assessor = new Assessors();
        $assessor->name = "Anneke der Kinderen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "H,D&A";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "26/09/1981")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Inge Stevens
        $assessor = new Assessors();
        $assessor->name = "Inge Stevens";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "H,D&A";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "04/07/1982")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Karin Cloudt
        $assessor = new Assessors();
        $assessor->name = "Karin Cloudt";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "H,D&A";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "3/31/1984")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Tanja Mers
        $assessor = new Assessors();
        $assessor->name = "Tanja Mers";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "H,D&A";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "6/22/1981")->toDateString();
        $assessor->function = "Instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Cathelijn Strijbosch
        $assessor = new Assessors();
        $assessor->name = "Cathelijn Strijbosch";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "8/20/1985")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Harold Meulendijks
        $assessor = new Assessors();
        $assessor->name = "Harold Meulendijks";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Welzijn";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "17/07/1978")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Hennita van de Mortel
        $assessor = new Assessors();
        $assessor->name = "Hennita van de Mortel";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "14/12/1962")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Ineke Ernest
        $assessor = new Assessors();
        $assessor->name = "Ineke Ernest";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "4/20/1966")->toDateString();
        $assessor->function = "Trainer/begeleider";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Inge Huybers
        $assessor = new Assessors();
        $assessor->name = "Inge Huybers";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Welzijn";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "7/7/1973")->toDateString();
        $assessor->function = "Instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Ilse Vossen
        $assessor = new Assessors();
        $assessor->name = "Ilse Vossen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "9/16/1966")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Marie-Cecile Martin- van Ommeren
        $assessor = new Assessors();
        $assessor->name = "Marie-Cecile Martin- van Ommeren";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "28/06/1972")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Marion van Wijk
        $assessor = new Assessors();
        $assessor->name = "Marion van Wijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "25/04/1959")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Sanneke van Zeeland
        $assessor = new Assessors();
        $assessor->name = "Sanneke van Zeeland";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "24/06/1984")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Saskia Moerman
        $assessor = new Assessors();
        $assessor->name = "Saskia Moerman";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "10/19/1980")->toDateString();
        $assessor->function = "Trainer/begeleider";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Thomas van de Elsen
        $assessor = new Assessors();
        $assessor->name = "Thomas van de Elsen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "3/16/1956")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Yvonne van de Boomen
        $assessor = new Assessors();
        $assessor->name = "Yvonne van de Boomen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Zorg en welzijn college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Niels van Dalsen")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Zorg";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "27/09/1982")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Anke Bruggink
        $assessor = new Assessors();
        $assessor->name = "Anke Bruggink";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs & Kinderopvang College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Peter de Roy van Zuijdewijn")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "O.A./ K.O.";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "2/17/1978")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Barbara Bierens
        $assessor = new Assessors();
        $assessor->name = "Barbara Bierens";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs & Kinderopvang College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Peter de Roy van Zuijdewijn")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "O.A./ K.O.";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "7/1/1986")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Hettie Jilesen
        $assessor = new Assessors();
        $assessor->name = "Hettie Jilesen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs & Kinderopvang College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Peter de Roy van Zuijdewijn")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "O.A./ K.O.";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "4/8/1961")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Ingeborg Krook
        $assessor = new Assessors();
        $assessor->name = "Ingeborg Krook";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs & Kinderopvang College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Peter de Roy van Zuijdewijn")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "O.A./ K.O.";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "08/04/1963")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Laila Hendriks
        $assessor = new Assessors();
        $assessor->name = "Laila Hendriks";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs & Kinderopvang College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Peter de Roy van Zuijdewijn")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "O.A./ K.O.";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "9/2/1974")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Margo Huijbers
        $assessor = new Assessors();
        $assessor->name = "Margo Huijbers";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs & Kinderopvang College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Peter de Roy van Zuijdewijn")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "O.A./ K.O.";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "2/25/1966")->toDateString();
        $assessor->function = "Instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Margriet van Mil
        $assessor = new Assessors();
        $assessor->name = "Margriet van Mil";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs & Kinderopvang College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Peter de Roy van Zuijdewijn")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "O.A./ K.O.";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "8/18/1976")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Tonnie Waals
        $assessor = new Assessors();
        $assessor->name = "Tonnie Waals";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs & Kinderopvang College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Peter de Roy van Zuijdewijn")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "O.A./ K.O.";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "5/18/1956")->toDateString();
        $assessor->function = "Instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Frank Berben
        $assessor = new Assessors();
        $assessor->name = "Frank Berben";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "10/2/1963")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Henry van Wanrooy
        $assessor = new Assessors();
        $assessor->name = "Henry van Wanrooy";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "11/07/1955")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Han op de Kelder
        $assessor = new Assessors();
        $assessor->name = "Han op de Kelder";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "17/10/1956")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Marcel Beekmans
        $assessor = new Assessors();
        $assessor->name = "Marcel Beekmans";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "29/08/1974")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Marcel Stabel
        $assessor = new Assessors();
        $assessor->name = "Marcel Stabel";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "14/04/1959")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Nihat Sahin
        $assessor = new Assessors();
        $assessor->name = "Marcel Stabel";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "02/08/1971")->toDateString();
        $assessor->function = "Instructeur A";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Peter Bessems
        $assessor = new Assessors();
        $assessor->name = "Peter Bessems";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "02/08/1971")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Peter Peels
        $assessor = new Assessors();
        $assessor->name = "Peter Peels";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "20/06/1961")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Rico van Dooren
        $assessor = new Assessors();
        $assessor->name = "Rico van Dooren";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "ict college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "ICT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "12/10/1981")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Eniko Hettema- Bilicz
        $assessor = new Assessors();
        $assessor->name = "Eniko Hettema- Bilicz";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "12/04/1969")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Hanny in 't Hout
        $assessor = new Assessors();
        $assessor->name = "Hanny in 't Hout";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "23/05/1958")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Heidrun Browarzik
        $assessor = new Assessors();
        $assessor->name = "Heidrun Browarzik";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "22/08/1968")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Lenie Hector-Filion
        $assessor = new Assessors();
        $assessor->name = "Lenie Hector-Filion";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 4, "01-02-2012", "02-02-2012");
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "30/05/1952")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Lotte Soontiëns
        $assessor = new Assessors();
        $assessor->name = "Lotte Soontiëns";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "2/23/1984")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Joke Loch
        $assessor = new Assessors();
        $assessor->name = "Joke Loch";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "10/01/1971")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Patsy Franssen
        $assessor = new Assessors();
        $assessor->name = "Patsy Franssen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "07/06/1957")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Peter van Breemen
        $assessor = new Assessors();
        $assessor->name = "Peter van Breemen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Onderwijs Centraal")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Richard Meulenberg")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "MVT";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "03/11/1954")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Bennie Cuijpers
        $assessor = new Assessors();
        $assessor->name = "Bennie Cuijpers";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "E&M";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "1/1/1965")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Bert van den Berg
        $assessor = new Assessors();
        $assessor->name = "Bert van den Berg";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "E&M";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "30/12/1956")->toDateString();
        $assessor->function = "Trainer/begeleider";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Cor van de Moosdijk
        $assessor = new Assessors();
        $assessor->name = "Cor van de Moosdijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 4, "01-02-2012", "02-02-2012");
        $assessor->team = "E&M";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "9/11/1956")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Jack van Dijk
        $assessor = new Assessors();
        $assessor->name = "Jack van Dijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Techniek n2/3";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "06/05/1976")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Joost Rooijakkers
        $assessor = new Assessors();
        $assessor->name = "Joost Rooijakkers";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Techniek n2/3";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "01/08/1976")->toDateString();
        $assessor->function = "instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Marieke Trip
        $assessor = new Assessors();
        $assessor->name = "Marieke Trip";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Techniek n2/3";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "29/06/1977")->toDateString();
        $assessor->function = "Kerndocent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Paul Groot
        $assessor = new Assessors();
        $assessor->name = "Paul Groot";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Techniek n2/3";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "19/05/1979")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Paul Versantvoort
        $assessor = new Assessors();
        $assessor->name = "Paul Versantvoort";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Techniek n2/3";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "15/12/1958")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Ron Gommans
        $assessor = new Assessors();
        $assessor->name = "Ron Gommans";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "E&M";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "06/05/1964")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Richard van den Elzen
        $assessor = new Assessors();
        $assessor->name = "Richard van den Elzen";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "E&M";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "18/05/1964")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Ruud Kuijken
        $assessor = new Assessors();
        $assessor->name = "Ruud Kuijken";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 2, "01-02-2014", "02-02-2014");
        $assessor->team = "Techniek n2/3";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "08/03/1957")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Vincent van de Camp
        $assessor = new Assessors();
        $assessor->name = "Ruud Kuijken";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Techniek & technologie college")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Kees Dings")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "E&M";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "11/22/1969")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        ## ASSESSORS ON NON ACTIEVE STATUS ##

        # Marie-Jose Janssens
        $assessor = new Assessors();
        $assessor->name = "Marie-Jose Janssens";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Bureau markt";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "07/03/1951")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 0;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Liesbeth Ehrismann
        $assessor = new Assessors();
        $assessor->name = "Liesbeth Ehrismann";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Bureau markt";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "19/02/1952")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 0;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Rik vd Ven
        $assessor = new Assessors();
        $assessor->name = "Rik vd Ven";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "H,D&A";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "23/02/1983")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 0;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Sebas Visser
        $assessor = new Assessors();
        $assessor->name = "Sebas Visser";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Business College")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Toine Ketelaars")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(false, false, true, true, false, null, null, 0, "23-05-2017", "30-05-2017", false, false);
        $assessor->team = "JSMC";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "8/8/1987")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 2;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        # Ad van Eijk
        $assessor = new Assessors();
        $assessor->name = "Ad van Eijk";
        $assessor->email = "test@test.nl";
        $assessor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(false, true, true, true, false, null, null, 0, false, false, false, false);
        $assessor->team = "Geüniformeerde beroepen";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "9/28/1955")->toDateString();
        $assessor->function = "Docent";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = $this->randProfession();
        $assessor->status = 2;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();
        # END

        ## END ##

        /** END ASSESSORS */

        /** Constructors */

        $constructor = new Constructors();
        $constructor->name = "Test Constructeur";
        $constructor->email = "Constructeur@test.nl";
        $constructor->fk_college = College::where('name', "Dienstverlening")->first()->id;
        $constructor->fk_teamleader = Teamleaders::where('name', "Mark van Knegsel")->first()->id;
        $constructor->team = "Geüniformeerde beroepen";
        $constructor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "9/28/1955")->toDateString();
        $constructor->status = 1;
        $constructor->log = '{ "log" : {} }';
        $constructor->save();

        /** END Constructors */

        /** HISTORY DEMO SEEDER */
        foreach (College::all() as $college) {
            $array = json_decode(Assessors::where("fk_college", $college->id)->get()->toJson(), true);
            $array = array_merge($array, $array);
            $rand = rand(1, 6);
            switch ($rand) {
                case 1:
                    foreach ($array as $key => $demoAssessor) {
                        $array[$key]['profession'] = $this->randProfession();
                    }
                    HistoryData::create(array(
                        'college' => $college->name,
                        'collegeid' => $college->id,
                        'actieve_assessors' => count($array),
                        'assessors' => json_encode($array),
                        'created_at' => \Carbon\Carbon::create(2016, 1, 1)->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::create(2016, 1, 1)->toDateTimeString()
                    ));
                    break;
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                    $count = count($array);
                    $perc = ($count / 100) * 80;
                    $removeAmount = round($count - $perc);
                    for ($i = 0; $i < $removeAmount; $i++) {
                        $array = array_splice($array, $i);
                    }
                    HistoryData::create(array(
                        'college' => $college->name,
                        'collegeid' => $college->id,
                        'actieve_assessors' => count($array),
                        'assessors' => json_encode($array),
                        'created_at' => \Carbon\Carbon::create(2016, 1, 1)->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::create(2016, 1, 1)->toDateTimeString()
                    ));
                    break;
            }
        }

        /** HISTORY DEMO SEEDER */
        foreach (College::all() as $college) {
            $array = json_decode(Assessors::where("fk_college", $college->id)->get()->toJson(), true);
            $array = array_merge($array, $array);
            $rand = rand(1, 6);
            switch ($rand) {
                case 1:
                    foreach ($array as $key => $demoAssessor) {
                        $array[$key]['profession'] = $this->randProfession();
                    }
                    HistoryData::create(array(
                        'college' => $college->name,
                        'collegeid' => $college->id,
                        'actieve_assessors' => count($array),
                        'assessors' => json_encode($array),
                        'created_at' => \Carbon\Carbon::create(2015, 1, 1)->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::create(2015, 1, 1)->toDateTimeString()
                    ));
                    break;
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                    $count = count($array);
                    $perc = ($count / 100) * 80;
                    $removeAmount = round($count - $perc);
                    for ($i = 0; $i < $removeAmount; $i++) {
                        $array = array_splice($array, $i);
                    }
                    HistoryData::create(array(
                        'college' => $college->name,
                        'collegeid' => $college->id,
                        'actieve_assessors' => count($array),
                        'assessors' => json_encode($array),
                        'created_at' => \Carbon\Carbon::create(2015, 1, 1)->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::create(2015, 1, 1)->toDateTimeString()
                    ));
                    break;
            }
        }

        /** END HISTORY SEEDER */
    }

    public function demoExamMaker($passed, $_vid, $_port, $_cv, $graduated, $exam_next, $training_next, $training_done, $p_date1 = null, $p_date2 = null, $present1 = true, $present2 = true)
    {
        if (!empty($p_date1)) {
            $date1 = $p_date1;
        } elseif ($p_date1 == false) {
            $date1 = "";
        } else {
            $date1 = \Carbon\Carbon::now()->format('d-m-Y');
        }
        if (!empty($p_date2)) {
            $date2 = $p_date2;
        } elseif ($p_date2 == false) {
            $date2 = "";
        } else {
            $date2 = \Carbon\Carbon::now()->format('d-m-Y');
        }
        $passed = ($passed) ? "true" : "false";
        $_vid = ($_vid) ? "true" : "false";
        $_port = ($_port) ? "true" : "false";
        $_cv = ($_cv) ? "true" : "false";
        $graduated = ($graduated) ? "true" : "false";
        $present1 = $present1 == true ? "true" : "false";
        $present2 = $present2 == true ? "true" : "false";
        $exam = new Exams();
        $exam->basictraining = trim(preg_replace('/\s\s+/', ' ', '
            {
              "passed": ' . $passed . ',
              "requirements": {
                "video": ' . $_vid . ',
                "portfolio": ' . $_port . ',
                "CV": ' . $_cv . '
              },
              "date1": {
                "present": ' . $present1 . ',
                "date": "' . $date1 . '"
              },
              "date2": {
                "present": ' . $present2 . ',
                "date": "' . $date2 . '"
              },
              "graduated": ' . $graduated . '
            }'));

        $exam->exam_next_on = $exam_next;
        $exam->training_next_on = $training_next;
        $exam->training_done = $training_done;
        $exam->log = '{}';
        $exam->save();

        return $exam->id;
    }

    public function randProfession()
    {
        $rand = rand(1, 3);
        switch ($rand) {
            case 1:
                return "Nederlands";
                break;
            case 2:
                return "Engels";
                break;
            case 3:
                return "Beroepstaak";
                break;
        }
    }
}
