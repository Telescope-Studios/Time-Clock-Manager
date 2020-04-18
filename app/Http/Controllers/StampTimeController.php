<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Employee;
use App\Job;
use App\Date;
use App\Timestamp;

class StampTimeController extends Controller
{
    public function index(){
    	return view('stamp.index');
    }

    public function store(Request $request){
    	if($request->ajax()){
    		$scan = $request->input('scan');

    		$employee = Employee::where('slug', $request->input('slug'))->get()->first();
    		if($employee == null){
    			return response()->json(['message'=>'Employee not found.'], 422);
    		}
    		if($scan){
    			return response()->json(['message'=>'Success', 'employee'=>$employee], 200);
    		}
    		$date = new Date();
        	$date->name = Carbon::now()->format('Y-m-d');
	       	$job = Job::find($employee->job->id);
	        $date->job()->associate($job);
	        $date->complete = false;
	        $date->timestamps()->associate(new Timestamp(['time' => Carbon::now()->format('H-i'), 'status'=>'checkin']));
	        $employee->dates()->associate($date);
	        $employee->save();

	        return response()->json(['message'=>'Time stamped successfully.', 'employee'=>$employee], 200);
    	}
    }
}