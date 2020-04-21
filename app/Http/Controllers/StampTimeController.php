<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Employee;
use App\Job;
use App\Date;

class StampTimeController extends Controller
{
    public function index(Request $request){
        $this->checkAuthorization($request);
    	return view('stamp.index');
    }

    public function store(Request $request){
        $this->checkAuthorization($request);
    	if($request->ajax()){
    		$scan = $request->input('scan');

    		$employee = Employee::where('slug', $request->input('slug'))->get()->first();
    		if($employee == null){
    			return response()->json(['message'=>'Employee not found.'], 422);
    		}
    		if($scan){
    			return response()->json(['message'=>'Success', 'employee'=>$employee], 200);
    		}
            $lastDate = $employee->dates()->last();
    		if($lastDate != null){
                if($lastDate->checkout != null){
                    $date = new Date();
                    $date->checkin = Carbon::now()->timestamp;
                    $employee->dates()->associate($date);
                }else{
                    $lastDate->checkout = Carbon::now()->timestamp;
                    $lastDate->save();
                }
            }else{
                $date = new Date();
                $date->checkin = Carbon::now()->timestamp;
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