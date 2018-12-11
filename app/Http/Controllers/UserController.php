<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\User;
// use App\Models\Department;
use Spatie\Permission\Models\Role;
use DB;
use App\Services\UserService;
use App\Services\TimesheetService;
use App\Repositories\DepartmentRepository;
use App\Repositories\PositionRepository;
use App\Repositories\ShiftRepository;
use App\Repositories\LeaveTypeRepository;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    private $userService;
    private $timesheetService;
    private $department;
    private $leaveTypeRepo;
    private $shiftRepo;
    private $position;
    private $paginate = 20;

    public function __construct(DepartmentRepository $department,
                                PositionRepository $position,
                                UserService $userService,
                                TimesheetService $timesheetService,
                                LeaveTypeRepository $leaveTypeRepo,
                                ShiftRepository $shiftRepo)
    {
        $this->userService = $userService;
        $this->timesheetService = $timesheetService;
        $this->department = $department;
        $this->shiftRepo = $shiftRepo;
        $this->leaveTypeRepo = $leaveTypeRepo;
        $this->position = $position;

        $this->middleware('can:do-action-if-user-or-admin,user_id', 
                    ['only' => 
                            ['schedule',
                            'schedule_update',
                            'file_leave',
                            'file_leave_create']
                    ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userService->paginate($this->paginate);

        return view('users.index',compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * $this->paginate);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = $this->department->pluck();
        $positions = $this->position->pluck();
       
        $roles = Role::pluck('name','name')->all();

        return view('users.create',compact('roles', 'departments', 'positions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            // 'roles' => 'required'
        ]);

        $input = $request->all();
        $this->userService->create($input);

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userService->find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->find($id);

        $departments = $this->department->pluck();
        $positions = $this->position->pluck();

        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user', 'roles', 'departments', 'positions', 'userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            // 'roles' => 'required'
        ]);


        $input = $request->all();

        $this->userService->update($input, $id);

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userService->find($id)->delete();
        
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }


    public function schedule(Request $request, $user_id)
    {
        $user = $this->userService->find($user_id);
        $employee_schedule = $user->employee_schedule()->first();
        
        $shifts = $this->shiftRepo->pluck();
        $schedule_types = ['fixed'=>'fixed', 'semi-flexible'=>'semi-flexible', 'flexible'=>'flexible']; // getScheduleTypes();

        return view('users.schedule', compact('user', 'employee_schedule', 'schedule_types', 'shifts'));
    }

    public function schedule_update(Request $request, $user_id)
    {        
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
        ]);

        $input = $request->all();
       
        $employee_schedule = $this->userService->updateSchedule($input, $input['id']);

        return redirect()->route('schedule_update', $input['user_id'])
                        ->with('success','User schedule updated successfully');
    }

    public function file_leave(Request $request, $user_id)
    {
        $user = $this->userService->find($user_id);
        $leave_types = $this->leaveTypeRepo->pluck();
        return view('users.file_leave', compact('user', 'leave_types'));
    }

    public function file_leave_create(Request $request, $user_id)
    {
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();

        $result = $this->userService->createLeave($input, $user_id);

        return redirect()->route('user_profile', [$user_id, $result->user->slug])
                        ->with('success','User file leave successfully');

    }


    public function profile(Request $request, $user_id, $slug)
    {
        
        if (Gate::allows('do-action-if-user-or-admin', $user_id)) {
            
            $dates = $this->timesheetService->getDaysBefore(10);
            $timesheets = $this->timesheetService->getInitialData($user_id);
            $user = $this->userService->getUserAllInfo($user_id);
            $leaves_per_type = $this->userService->getRemainingLeavesPerType($user_id);

            return view('users.profile', compact('user','timesheets', 'dates', 'leaves_per_type'));

        }else{
            return redirect()->route('dashboard')
                        ->with('warning','You are not allowed to accesss other Profile.');
        }
    }

    public function approve_leave(Request $request, $user_id)
    {
        $result = $this->userService->updateLeave(['is_approve'=> 1], $request->id);
        
        $user = $this->userService->find($user_id);

        return redirect()->route('user_profile', [$user_id, $user->slug])
                        ->with('success','User leave approved successfully');
    }

    public function deny_leave(Request $request, $user_id)
    {
        $this->userService->updateLeave(['is_approve'=> 0], $request->id);
        
         $user = $this->userService->find($user_id);

        return redirect()->route('user_profile', [$user_id, $user->slug])
                        ->with('success','User leave denied successfully');
    }
    public function verify(Request $request, $user_id)
    {
        $this->userService->verify($user_id);
        
        return redirect()->route('users.index')
                        ->with('success','User verified successfully');
    }
}