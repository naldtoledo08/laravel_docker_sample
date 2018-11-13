<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TimesheetService;
use App\Services\UserService;
use Auth;

class TimesheetController extends Controller
{
    private $timesheetService;
    private $userService;
    private $user_id;
    private $paginate = 20;

    public function __construct(UserService $userService, TimesheetService $timesheetService)
    {
        $this->userService  = $userService;
        $this->timesheetService  = $timesheetService;
        $this->user_id = Auth::id();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->paginate($this->paginate);

        return view('timesheets.index',compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function login(Request $request)
    {
        $user_id = $request->user_id;
        $input = [
            'user_id' => $user_id,
            'date' => date('Y-m-d'),
            'time_in' => date('Y-m-d h:i:s')
        ];

        $this->timesheetService->create($input);

        return redirect()->route('timesheets.show', $user_id)
                        ->with('success','You are already Login.');
    }

    public function logout(Request $request)
    {
        $id = $request->id;        
        $user_id = $request->user_id;
        $input = [
            'time_out' => date('Y-m-d h:i:s')
        ];

        $this->timesheetService->update($input, $id);

        return redirect()->route('timesheets.show', $user_id)
                        ->with('success','You are already Logout.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dates = $this->timesheetService->getDaysBefore(10);
        $today = date('Y-m-d');
        $user = $this->userService->find($id);
        $timesheets = $this->timesheetService->getInitialData($id);

        return view('timesheets.show',compact('timesheets', 'user', 'dates', 'today', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Timesheet $timesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timesheet $timesheet)
    {
        //
    }
}
