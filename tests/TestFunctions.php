<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Exams;
use App\Log;
use App\Teamleaders;
use App\TiC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Support\Facades\Input;

class AssessorController extends Controller
{
    public function test2()
    {
        Excel::create('Assessor Lijst Layout', function ($excel) {

            // Set the title
            $excel->setTitle('Assessor Lijst Layout');

            // Chain the setters
            $excel->setCreator('RocTracker')
                ->setCompany('MRG Studios')
                ->setTitle('Assessor Lijst')
                ->setDescription('Deze layout zal gebruikt worden om assessoren lijsten te importeren in het systeem');

            // Our first sheet
            $excel->sheet('Lijst', function ($sheet) {
                /*// Advanced protect
                $sheet->protect('ROCTRACKER', function(\PHPExcel_Worksheet_Protection $protection) {
                    $protection->setSort(true);
                });*/

                $sheet->row(1, array(
                    'Naam deelnemer', 'Naam College', 'Naam Team', 'Geboorte Datum', 'Functie', 'Training verzorgd door', 'Diploma uitgegeven door', 'Naam Teamleider (1 Persoon)', 'Status (Actief, Non-actief, Anders)', 'Basistraining behaald (Ja/Nee)',
                ));

                // Set width for multiple cells
                $sheet->setWidth(array(
                    'A' => 25,
                    'B' => 25,
                    'C' => 20,
                    'D' => 20,
                    'E' => 11,
                    'F' => 38,
                    'G' => 30,
                    'H' => 30,
                    'I' => 38,
                    'J' => 40
                ));

                // Set height for a single row
                $sheet->setHeight(1, 50);

                $sheet->cells('A1:J1', function ($cells) {
                    // manipulate the range of cells
                    $cells->setBackground('#FFFF00');
                    // Set font
                    $cells->setFont(array(
                        'family' => 'Verdana',
                        'size' => '12',
                        'bold' => true
                    ));
                    // Set all borders (top, right, bottom, left)
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    // Set vertical alignment to middle
                    $cells->setValignment('center');
                });

                // Set border for range
                $sheet->setBorder('A1:J1', 'thin');

                // Set auto filter for a range
                $sheet->setAutoFilter('A1:J1');

                // Set multiple column formats
                $sheet->setColumnFormat(array(
                    'D' => 'yyyy-mm-dd'
                ));
            });

        })->download('xlsx');
    }

    public function test()
    {
        Excel::load(public_path() . '/Assessor Lijst Layout.xlsx', function ($reader) {
            $reader = $reader->toArray();
            $sheet = count($reader) > 1 ? $reader[0] : $reader;
            $rows = $sheet;

            $approvedRows = array();
            $rejectedRows = array();

            foreach ($rows as $row) {
                $validator = Validator::make($row, array(
                    'naam_deelnemer' => 'required|max:255|min:2',
                    'naam_college' => '',
                    'naam_team' => '',
                    'geboorte_datum' => 'required|',
                    'functie' => 'required|max:255',
                    'training_verzorgd_door' => '',
                    'diploma_uitgegeven_door' => '',
                    'naam_teamleider_1_persoon' => '',
                    'status_actief_non_actief_anders' => 'required',
                    'basistraining_behaald_janee' => '',
                ));

                if ($validator->fails()) {
                    $rejectedRows[] = $row;
                    continue;
                }

                $basictraining = strtolower($row['basistraining_behaald_janee']) == 'ja' ? true : false;

                switch (strtolower($row['status_actief_non_actief_anders'])) {
                    case 'actief':
                        $status = 1;
                        break;
                    case 'non-actief':
                        $status = 0;
                        break;
                    case 'niet-actief':
                        $status = 0;
                        break;
                    case 'anders':
                        $status = 2;
                        break;
                    default:
                        $status = 2;
                        break;
                }
                $assessor = new Assessors();
                $assessor->name = $row['naam_deelnemer'];
                $assessor->birthdate = $row['geboorte_datum']->format('Y-m-d');
                $assessor->fk_college = !empty(College::where('name', $row['naam_college'])->first()) ? College::where('name', $row['naam_college'])->first()->id : null;
                $assessor->function = $row['functie'];
                $assessor->team = $row['naam_team'];
                $assessor->trained_by = $row['training_verzorgd_door'];
                $assessor->certified_by = $row['diploma_uitgegeven_door'];
                $assessor->status = $status;
                $assessor->fk_exams = Exams::NewAssessor($basictraining);
                $assessor->log = '{"log" : {}}';
                $assessor->save();

                $approvedRows[] = $row;
            }

            dd($approvedRows);
        });
    }
}