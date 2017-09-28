<?php

namespace App\Http\Controllers;

use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class ScheduleController extends Controller
{
    public function getSchedule(Request $request){


        $date = new DateTime($request->get('start_date'));
        $days =     $request->get('days_per_week');
        $sessionsPerChapter = $request->get('chapter_sessions');
        $weekStartDate = 6;
        $numberOfChapter = 10;
        for ($i =0 ; $i < count($days);$i ++){
            $temp = $days[$i]+ $weekStartDate;
            $days [$i] = ($temp<7)?$temp:$temp%7;
        }

        $sessions = array();

        for($i = 0 ; $i < $sessionsPerChapter * $numberOfChapter ;  ) {

            $date = $date ->add(new DateInterval("P1D"));
            if (in_array($date->format('w'),$days)){
                array_push($sessions,$date->format('d-m-Y'));
                $i++;
            }

        }

        return response()->json(["sessions"=>$sessions],200);
    }

}
