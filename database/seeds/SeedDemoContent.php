<?php

use Illuminate\Database\Seeder;
use App\Teamleaders;
use App\College;
use App\Assessors;
use App\Exams;
use App\TiC;
use App\Log;
use App\Maintenance;

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

        $assessor = new Assessors();
        $assessor->name = "Christien Heesters";
        $assessor->fk_college = College::where('name', "Presta")->first()->id;
        $assessor->fk_teamleader = Teamleaders::where('name', "Yvon Pas")->first()->id;
        $assessor->fk_exams = $this->demoExamMaker(true, true, true, true, true, null, null, 0);
        $assessor->team = "Educatie";
        $assessor->birthdate = \Carbon\Carbon::createFromFormat('d/m/Y', "11/22/1959")->toDateString();
        $assessor->function = "Instructeur";
        $assessor->trained_by = "Helicon";
        $assessor->certified_by = "Provex";
        $assessor->profession = "Nederlands";
        $assessor->status = 1;
        $assessor->log = '{ "log" : {} }';
        $assessor->save();

        /** END ASSESSORS */
    }

    public function demoExamMaker($passed, $_vid, $_port, $_cv, $graduated, $exam_next, $training_next, $training_done)
    {
        $exam = new Exams();
        $exam->basictraining = trim(preg_replace('/\s\s+/', ' ', '
            {
              "passed": '.$passed == true ? "true" : "false".',
              "requirements": {
                "video": '.$_vid == true ? "true" : "false".',
                "portfolio": '.$_port == true ? "true" : "false".',
                "CV": '.$_cv == true ? "true" : "false".'
              },
              "date1": {
                "present": true,
                "date": '.\Carbon\Carbon::now()->format('d-m-Y').'
              },
              "date2": {
                "present": true,
                "date": '.\Carbon\Carbon::now()->format('d-m-Y').'
              },
              "graduated": '.$graduated == true ? "true" : "false".'
            }'));

        $exam->exam_next_on = $exam_next;
        $exam->training_next_on = $training_next;
        $exam->training_done = $training_done;
        $exam->log = '{}';
        $exam->save();

        return $exam->id;
    }
}
