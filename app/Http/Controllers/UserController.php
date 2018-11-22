<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use DB;
use App\Services\UserService;
use App\Repositories\DepartmentRepository;
use App\Repositories\PositionRepository;


class UserController extends Controller
{
    private $userService;
    private $department;
    private $position;
    private $paginate = 20;

    public function __construct(DepartmentRepository $department, PositionRepository $position, UserService $userService)
    {
        $this->userService = $userService;
        $this->department = $department;
        $this->position = $position;
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
            'name' => 'required',
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
            'name' => 'required',
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
}