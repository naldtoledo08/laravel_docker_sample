<?php

namespace App\Http\Controllers;

use App\Repositories\ShiftRepository;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    private $shift = null;
    private $paginate = 20;

    public function __construct(ShiftRepository $shiftRepo)
    {
        $this->shiftRepo = $shiftRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = $this->shiftRepo->paginate($this->paginate);

        return view('shifts.index',compact('shifts'))
            ->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shifts.create');
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

        $this->shiftRepo->create($request->all());

        return redirect()->route('shifts.index')
                        ->with('success','Shift created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $shift = $this->shiftRepo->show($id);
        return view('shifts.show', compact('shift'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $shift = $this->shiftRepo->show($id);
        return view('shifts.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->shiftRepo->update($request->all(), $id);

        return redirect()->route('shifts.index')
                        ->with('success','Shift updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->shiftRepo->delete($id);

        return redirect()->route('shifts.index')
                        ->with('success','Shift deleted successfully');
    
    }
}
