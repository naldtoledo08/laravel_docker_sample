<?php

namespace App\Http\Controllers;

use App\Models\Remote;
use Illuminate\Http\Request;
use App\Repositories\RemoteRepository;

class RemoteController extends Controller
{

    private $remoteRepo = null;
    private $paginate = 20;

    public function __construct(RemoteRepository $remoteRepo)
    {
        $this->remoteRepo = $remoteRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $remotes = $this->remoteRepo->paginate($this->paginate);

        return view('remotes.index',compact('remotes'))
            ->with('i', (request()->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('remotes.create');
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
            'ip_address' => 'required',
        ]);

        $this->remoteRepo->create($request->all());

        return redirect()->route('remotes.index')
                        ->with('success','Remote details created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remote  $remote
     * @return \Illuminate\Http\Response
     */
    public function show(Remote $remote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Remote  $remote
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $remote = $this->remoteRepo->show($id);
        return view('remotes.edit', compact('remote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Remote  $remote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'ip_address' => 'required',
        ]);

        $this->remoteRepo->update($request->all(), $id);

        return redirect()->route('remotes.index')
                        ->with('success','Remote details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remote  $remote
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->remoteRepo->delete($id);

        return redirect()->route('remotes.index')
                        ->with('success','Remote details deleted successfully');
    }
}
