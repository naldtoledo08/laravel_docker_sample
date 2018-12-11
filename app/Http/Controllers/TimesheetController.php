<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TimesheetService;
use App\Services\UserService;
use Auth;
use Illuminate\Support\Facades\Gate;

class TimesheetController extends Controller
{
    private $timesheetService;
    private $userService;
    private $paginate = 20;

    public function __construct(UserService $userService, TimesheetService $timesheetService)
    {
        $this->userService  = $userService;
        $this->timesheetService  = $timesheetService;

        //$this->middleware('permission:timesheet-summary', ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $user = Auth::user();
        if($user->hasPermissionTo('timesheet-summary')) {
            
            $users = $this->timesheetService->getUsersTimesheetSummary();

            return view('timesheets.index',compact('users'))
                ->with('i', ($request->input('page', 1) - 1) * $this->paginate);
                
        }else{
            return redirect()->route('timesheets.show', $user->id)
                        ->with('warning','You are not allowed to access Timesheet Summary.');
        }
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
        $user = Auth::user();

        if (Gate::allows('do-action-if-user-or-admin', $user_id)  && $user->can('remote-access')) {
            $input = [
                'user_id' => $user_id,
                'date' => date('Y-m-d'),
                'remarks' => $this->timesheetService->getRemarks($user , 'login')
            ];

            $timesheet = $this->timesheetService->login($input);
            
            return redirect()->route('timesheets.show', $user_id)
                            ->with('success','You are already Login.');
        } else {
            return redirect()->route('timesheets.show', $user->id)
                        ->with('warning','You are not allowed to access other Timesheet.');
        }
    }

    public function logout(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id;

        $user = Auth::user();

        if (Gate::allows('do-action-if-user-or-admin', $user_id)  && $user->can('remote-access')) {

            $input = $request->all();
            
            $input['remarks'] = $this->timesheetService->getRemarks($user , 'logout');

            $this->timesheetService->logout($input);

            return redirect()->route('timesheets.show', $user_id)
                            ->with('success','You are already Logout.');
        } else {
            return redirect()->route('timesheets.show', $user->id)
                        ->with('warning','You are not allowed to access other Timesheet.');
        }
    }

    public function logout_old(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id;

        $user = Auth::user();

        if ($user->hasRole('admin')) {

            $input = $request->all();
            
            $input['remarks'] = $this->timesheetService->getRemarks($user , 'logout');

            $this->timesheetService->logout($input);

            return redirect()->route('timesheets.show', $user_id)
                            ->with('success','You are already Logout.');
        } else {
            return redirect()->route('timesheets.show', $user->id)
                        ->with('warning','You are not allowed to access other Timesheet.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timesheet  $timesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
        $user = Auth::user();

        if (Gate::allows('do-action-if-user-or-admin', $id)) {
            
            if($user->hasRole('admin') && $user->id == $id){
                return redirect()->route('timesheets.index')
                        ->with('warning','Administrators are not allowed to Log on their own Timesheet.');
            }

            $dates = $this->timesheetService->getDaysBefore(10);
            $today = date('Y-m-d');
            $user = $this->userService->find($id);
            $timesheets = $this->timesheetService->getInitialData($id);

            return view('timesheets.show',compact('timesheets', 'user', 'dates', 'today', 'id'));
        }else{
            return redirect()->route('timesheets.show', $user->id)
                        ->with('warning','You are not allowed to accesss other Timesheet.');
        }
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
    public function destroy(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id;

        $user = Auth::user();
        if($user->hasRole('admin')) {
              
            $this->timesheetService->delete($id);

            return redirect()->route('timesheets.show', $user_id)
                            ->with('success','Time-in successfully deleted');

         }else{
            return redirect()->route('timesheets.show', $user->id)
                        ->with('warning','You are not allowed to delete Timesheet.');
        }
    }
}
