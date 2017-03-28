<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class HistoryData extends Model
{
    public static function generate()
    {
        $data = array();
        foreach (College::all() as $college) {
            $data[$college->id] = array(
                'current' => date('Y'),
                'should' => 1 + round(Assessors::where('fk_college', $college->id)->where('status', 1)->count() / 100 * 110),
                'count' => Assessors::where('fk_college', $college->id)->where('status', 1)->count()
            );
        }
        return $data;
    }

    public static function CollegeData($id)
    {
        $data = array();
        $current = Assessors::where('fk_college', $id)->where('status', 1)->get();
        if (!empty($current)) {
            $currentKeyDate = Carbon::now()->startOfYear()->toDateString();
            $currentProfessions = array();
            foreach ($current as $assessor) {
                if (array_key_exists($assessor->profession, $currentProfessions)) {
                    $currentProfessions[$assessor->profession]++;
                }else {
                    $currentProfessions[$assessor->profession] = 1;
                }
            }
            $data[$currentKeyDate] = $currentProfessions;
        }
        $dataHistory = HistoryData::where('created_at', '<', Carbon::now()->startOfYear())->where('collegeid', $id)->get();
        foreach ($dataHistory as $collegeData) {
            $dataHistory_assessors = json_decode($collegeData->assessors);
            $keyDate = Carbon::createFromFormat('Y-m-d H:i:s', $collegeData->created_at)->startOfYear()->toDateString();
            $professions = array();
            foreach ($dataHistory_assessors as $assessor) {
                if ($assessor->status != 1) {
                    continue;
                }
                if (array_key_exists($assessor->profession, $professions)) {
                    $professions[$assessor->profession]++;
                }else {
                    $professions[$assessor->profession] = 1;
                }
            }
            $data[$keyDate] = $professions;
        }
        $diffrentLabels = array();
        foreach ($data as $year_professions) {
            foreach ($year_professions as $profession => $actieve_assessors) {
                if (!array_key_exists($profession, $diffrentLabels)) {
                    $diffrentLabels[$profession] = null;
                }
            }
        }

        foreach ($data as $bar => $barData) {
            foreach ($diffrentLabels as $label => $null) {
                if (!array_key_exists($label, $barData)){
                    $data[$bar][$label] = 0;
                }
            }
        }

        $dataBars = array();
        foreach ($diffrentLabels as $dataBar => $null) {
            $i = 0;
            foreach ($data as $bar => $barData) {
                $dataBars[$dataBar][] = array(
                    0 => Carbon::createFromFormat('Y-m-d', $bar)->format("d/m/Y"),
                    1 => $barData[$dataBar]
                );
                $i++;
            }
        }
        /*dd($dataBars);*/
        return json_encode($dataBars);

    }
}
