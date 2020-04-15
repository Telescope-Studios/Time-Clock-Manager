<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Date;
use App\Timestamp;
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
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $employee->job = $request->input('job');
        $employee->push();

        /*$user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('qwerty');
        $user->push();
        $user->roles()->associate(Role::find('5e9580891bb431092867b6f3'));
        $user->save();*/


        /*$date = new Date();
        $date->name = Carbon::now()->format('Y-m-d');
        $job = Job::find($employee->job);
        $date->job()->associate($job);
        $date->complete = false;
        $date->timestamps()->associate(new Timestamp(['time' => Carbon::now()->format('H-i'), 'status'=>'checkin']));
        $employee->dates()->associate($date);
        $employee->save();*/
        return redirect()->route('employee.index')->with('status', 'The profile has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
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
        $validatedData = $request->validate([
            'firstname'=>'required|alpha_spaces',
            'lastname'=>'required|alpha_spaces',
            'slug'=>'required|unique:employee_collection,slug,'.$employee->id.',_id'
        ]);
        //return $employee->id;
        //Todo: This is not validating properly
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
            $file_path = public_path().'/images/'.$employee->avatar;
            \File::delete($file_path);
            $employee->avatar = $name;
        }
        $employee->active = $request->input('active') == 'on' ? true : false;
        $employee->update($request->all());
        return redirect()->route('employee.index')->with('status', 'The profile has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $file_path = public_path().'/images/'.$employee->avatar;
        \File::delete($file_path);
        $employee->delete();
        return redirect()->route('employee.index');
    }

    public function generateCard($slug){
        if($request->user() == null){
            abort(401);
        }
        $request->user()->authorizeRoles(['Admin']);
        $employee = Employee::where('slug', $slug)->get()->first();
        //return $employee;
        //$pdf = PDF::loadView('employee.card', compact('employee'));

        //$pdf->setPaper('a4','portrait');
        return view('employee.card', compact('employee'));
    }

    public function showTimesheet($slug){
        $employee = Employee::where('slug', $slug)->get()->first();
        //return $employee;
        return view('employee.showtimesheet', compact('employee'));
    }
}
