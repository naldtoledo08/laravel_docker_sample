<?php

namespace App\Http\Controllers;

use App\Repositories\PositionRepository;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    private $position = null;
    private $paginate = 20;

    public function __construct(PositionRepository $position)
    {
        $this->position = $position;

        $this->middleware('permission:position-list');
        $this->middleware('permission:position-create', ['only' => ['create','store']]);
        $this->middleware('permission:position-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:position-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = $this->position->paginate($this->paginate);

        return view('positions.index',compact('positions'))
            ->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
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
            'title' => 'required',
            'description' => 'required',
        ]);

        $this->position->create($request->all());

        return redirect()->route('positions.index')
                        ->with('success','Position created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $position = $this->position->show($id);
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $position = $this->position->show($id);
        return view('positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $this->position->update($request->all(), $id);

        return redirect()->route('positions.index')
                        ->with('success','Position updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->position->delete($id);

        return redirect()->route('positions.index')
                        ->with('success','Position deleted successfully');
    
    }
}