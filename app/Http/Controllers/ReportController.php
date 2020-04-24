<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeReport;
use App\Report;
use App\Job;
use App\Http\Requests\GenerateReportRequest;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();
        return view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::all();
        return view('report.create', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenerateReportRequest $request)
    {
        /*$employees = Employee::where('job._id', $request->input('job'))->get();
        return $employees;*/
        $report = new Report();
        $from = $request->input('from');
        $to = $request->input('to');
        $report->from = Carbon::parse($from)->timestamp;
        $report->to = Carbon::parse($to)->timestamp;
        $report->push();
        $report->job()->associate(Job::find($request->input('job')));
        $report->save();
        return redirect()->route('report.index')->with('status', 'The report has been generated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        $employees = Employee::where('job._id', $report->job->id)->where('active', true)->get();
        $employeereports = array();
        foreach ($employees as $employee) {
            $employeereport = new EmployeeReport();
            $dates = $employee->dates()->where('checkin', '>=', $report->from)->where('checkout', '<=', $report->to);
            $total = 0;
            $first = null;
            $last = null;
            foreach ($dates as $date) {
                if($date->checkout == null) continue;//unfinished checkout
                if($first == null || $first > $date->checkin){
                    $first = $date->checkin;
                }
                if($last == null || $last < $date->checkout){
                    $last = $date->checkout;
                }
                $total += ($date->checkout - $date->checkin);
            }
            $total = $total/3600;
            $employeereport->employee = $employee;
            $employeereport->from = $first;
            $employeereport->to = $last;
            $employeereport->hours = $total;
            array_push($employeereports, $employeereport);
        }
        return view('report.show', compact('report', 'employeereports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        $jobs = Job::all();
        return view('report.edit', compact('report', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(GenerateReportRequest $request, Report $report)
    {
        $report->job()->associate(Job::find($request->input('job')));
        $report->from = Carbon::parse($request->input('from'))->timestamp;
        $report->to = Carbon::parse($request->input('to'))->timestamp;
        $report->save();

        return redirect()->route('report.index')->with('status', 'The report has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('report.index');
    }
}
