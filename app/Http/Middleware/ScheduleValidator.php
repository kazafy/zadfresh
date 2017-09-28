<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Input;
use Validator;
use Closure;

class ScheduleValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $validator = Validator::make($request->all(),                                        //////////////////////////////////////////////////
            [ 'start_date'        =>  'required|date_format:Y-m-d|after_or_equal:now',      // the start date must be in future             //
                'days_per_week'     =>  'required|array|max:7',                            //  array length smaller than 7                 //
                'days_per_week.*'   =>  'distinct|integer|min:0|max:6   ',                //   array of days must be distinct             //
                'chapter_sessions'  =>  'required|integer']);                            //    number of session per chapter must be int //
                                                                                        //////////////////////////////////////////////////

        if ($validator->fails()) {

                $messages = $validator->messages();
                return response()->json($messages,400);
            }
        else
            {
                return $next($request);
            }
    }
}
