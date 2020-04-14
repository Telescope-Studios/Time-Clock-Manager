<?php

namespace App\Http\Controllers;

use App\Employee;
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
        return view('employee.create');
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
        $employee->push();

        return redirect()->route('employee.index');
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
        return view('employee.edit', compact('employee'));
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
            'firstname'=>'required|max: 20',
            'lastname'=>'required|max: 20',
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
        $employee->update($request->all());
        return redirect()->route('employee.show', [$employee])->with('status', 'The profile has been updated successfully.');
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
}
