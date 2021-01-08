<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Job;
use App\Date;

class StampTimeController extends Controller
{
    public function index(Request $request){
        $this->checkAuthorization($request);

        if($request->ajax()){
            $employee_slug = $request->input('slug');
            if($employee_slug == null){
                return response()->json(['message'=>'Missing slug param'], 422);
            }
            $employee = Employee::where('slug', $employee_slug)->get()->first();
            if($employee == null){
                return response()->json(['message'=>'Employee not found.'], 422);
            }else{
                return response()->json(['message'=>'Success', 'employee'=>$employee], 200);
            }
        }

    	return view('stamp.index');
    }

    public function store(Request $request){
        $this->checkAuthorization($request);
    	if($request->ajax()){
            $employee_slug = $request->input('slug');
            if($employee_slug == null){
                return response()->json(['message'=>'Missing slug param'], 422);
            }
    		$employee = Employee::where('slug', $employee_slug)->get()->first();
            $time = $request->input('time');

            if($employee == null){
    			return response()->json(['message'=>'Employee not found.'], 422);
            }
            if($time == null){
                return response()->json(['message'=>'Time not found.'], 422);
            }

            //Todo: redo time check with new format
            $lastDate = $employee->dates()->last();
    		if($lastDate != null){
                if($lastDate->checkout != null){
                    $date = new Date();
                    $date->checkin = $request->input('time');
                    $employee->dates()->associate($date);
                }else{
                    $lastDate->checkout = $request->input('time');
                    $lastDate->save();
                }
            }else{
                $date = new Date();
                $date->checkin = $request->input('time');
                $employee->dates()->associate($date);
            }
	        $employee->save();
	        return response()->json(['message'=>'Time stamped successfully.', 'employee'=>$employee], 200);
    	}
    }

    public function checkAuthorization(Request $request){
        if($request->user() != null){
            $request->user()->authorizeRoles(['Admin']);
        }else{
            abort(401);
        }
    }
}