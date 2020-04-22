<?php

namespace App\Http\Controllers;

use App\Date;
use App\Employee;
use App\Job;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkAuthorization($request);
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->checkAuthorization($request);
        $jobs = Job::all();
        return view('employee.create', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $this->checkAuthorization($request);
        $employee = new Employee();
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $employee->avatar = $name;
            $file->move(public_path().'/images/', $name);
        }
        $employee->firstname = $request->input('firstname');
        $employee->lastname = $request->input('lastname');
        $employee->active = $request->input('active') == 'on' ? true : false;
        $employee->slug = $request->input('slug');
        $employee->job = Job::find($request->input('job'));
        $employee->push();

        return redirect()->route('employee.index')->with('status', 'The profile has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, Request $request)
    {
        $this->checkAuthorization($request);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee, Request $request)
    {
        $this->checkAuthorization($request);
        $jobs = Job::all();
        return view('employee.edit', compact('employee', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->checkAuthorization($request);
        $validatedData = $request->validate([
            'firstname'=>'required|alpha_spaces',
            'lastname'=>'required|alpha_spaces',
            'slug'=>'required|unique:employee_collection,slug,'.$employee->id.',_id'
        ]);
        $old_avatar = $employee->avatar;
        $employee->update($request->all());
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $file_path = public_path().'/images/'.$old_avatar;
            \File::delete($file_path);
            $employee->avatar = $name;
            $file->move(public_path().'/images/', $name);
        }
        $employee->active = $request->input('active') == 'on';
        $employee->job()->associate(Job::find($request->input('job')));
        $employee->save();
        return redirect()->route('employee.index')->with('status', 'The profile has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, Request $request)
    {
        $this->checkAuthorization($request);
        $file_path = public_path().'/images/'.$employee->avatar;
        \File::delete($file_path);
        $employee->delete();
        return redirect()->route('employee.index');
    }

    public function generateCard(Employee $employee, Request $request)
    {
        $this->checkAuthorization($request);
        return view('employee.card', compact('employee'));
    }

    public function getTimestampsBetween(Employee $employee, Request $request){
        //return Carbon::parse('04/30/2020 4:03 AM')->timestamp;
        $dates = $employee->dates()->where('checkin', '>=', '1587512936')->where('checkout', '<=', '1587524273');
        return $dates;
    }

    public function checkAuthorization(Request $request){
        if($request->user() != null){
            $request->user()->authorizeRoles(['Admin']);
        }else{
            abort(401);
        }
    }
}
