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
        $weekStartDate = 6;                                        // dynamic start date of week dynamic
        $numberOfChapter = 10;

        // handel if week  didn't  start at sunday
        for ($i =0 ; $i < count($days);$i ++){
            $temp = $days[$i]+ $weekStartDate;
            $days [$i] = ($temp<7)?$temp:$temp%7;
        }

        $sessions = array();

        /// loop from start date to un-finite
        //  until number of sessions complete

        for($i = 0 ; $i < $sessionsPerChapter * $numberOfChapter ;  ) {

            $date = $date ->add(new DateInterval("P1D"));
            //// increment only if the index of the day in the student selected days
            if (in_array($date->format('w'),$days)){
                array_push($sessions,$date->format('d-m-Y'));
                $i++;
            }

        }

        return response()->json(["sessions"=>$sessions],200);


        //      another way to solve the problem


//        $startDate = new DateTime($request->get('start_date'));

//        $date = new DateTime(date('d-m-Y', strtotime('last Sunday', strtotime($request->get('start_date')))));
//        $sessions = array();
//        sort($days);
//        print_r($days);
//
//        while ( count($sessions)<$sessionsPerChapter * $numberOfChapter ){
//
//            foreach ($days as $d){
//                $temp = clone $date ;
//                $temp->add(new DateInterval("P".($d)."D"));
//                if($temp>$startDate){
//                    array_push($sessions,$temp->format('d-m-Y'));
//                }
//            }
//            $date = $date ->add(new DateInterval("P7D"));
//        }
//
//        return response()->json(["sessions"=>$sessions],200);

    }

}
