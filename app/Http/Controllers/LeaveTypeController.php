<?php

namespace App\Http\Controllers;

use App\Repositories\LeaveTypeRepository;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    private $leaveTypeRepo = null;
    private $paginate = 20;

    public function __construct(LeaveTypeRepository $leaveTypeRepo)
    {
        $this->leaveTypeRepo = $leaveTypeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leave_types = $this->leaveTypeRepo->paginate($this->paginate);

        return view('leave_types.index',compact('leave_types'))
            ->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->leaveTypeRepo->create($request->all());

        return redirect()->route('leave-types.index')
                        ->with('success','Leave Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveType  $leave_type
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $leave_type = $this->leaveTypeRepo->show($id);
        return view('leave_types.show', compact('leave_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveType  $leave_type
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $leave_type = $this->leaveTypeRepo->show($id);
        return view('leave_types.edit', compact('leave_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveType  $leave_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->leaveTypeRepo->update($request->all(), $id);

        return redirect()->route('leave-types.index')
                        ->with('success','Leave Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveType  $leave_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->leaveTypeRepo->delete($id);

        return redirect()->route('leave-types.index')
                        ->with('success','Leave Type deleted successfully');
    
    }
}
