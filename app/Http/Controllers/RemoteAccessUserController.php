<?php

namespace App\Http\Controllers;

use App\Models\RemoteAccessUser;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\RemoteAccessRepository;

class RemoteAccessUserController extends Controller
{

    private $remoteAccessRepo;
    private $userRepo;    
    private $paginate = 20;

    public function __construct(RemoteAccessRepository $remoteAccessRepo, UserRepository $userRepo)
    {
        $this->remoteAccessRepo = $remoteAccessRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $remote_access = $this->remoteAccessRepo->paginate($this->paginate);

        return view('remote_access.index',compact('remote_access'))
            ->with('i', ($request->input('page', 1) - 1) * $this->paginate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->userRepo->pluck();

        return view('remote_access.create',compact('users'));
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
            'user_id' => 'required',
            'from' => 'required',
        ]);

        $input = $request->all();
        $input['is_approve'] = 1;

        $this->remoteAccessRepo->create($input);

        return redirect()->route('remote-access.index')
                        ->with('success','User remote access created successfully');
    }

    public function approve(Request $request)
    {
        $this->remoteAccessRepo->update(['is_approve'=> 1], $request->id);
        
        return redirect()->route('remote-access.index')
                        ->with('success','User remote access approved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RemoteAccessUser  $remoteAccessUser
     * @return \Illuminate\Http\Response
     */
    public function show(RemoteAccessUser $remoteAccessUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RemoteAccessUser  $remoteAccessUser
     * @return \Illuminate\Http\Response
     */
    public function edit(RemoteAccessUser $remoteAccessUser, $id)
    {
        $remote_access = $this->remoteAccessRepo->find($id);        
        $users = $this->userRepo->pluck();

        return view('remote_access.edit',compact('remote_access', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RemoteAccessUser  $remoteAccessUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RemoteAccessUser $remoteAccessUser, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'from' => 'required',
        ]);

        $input = $request->all();

        $this->remoteAccessRepo->update($input, $id);

        return redirect()->route('remote-access.index')
                        ->with('success','User remote access updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RemoteAccessUser  $remoteAccessUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(RemoteAccessUser $remoteAccessUser)
    {
        //
    }
}
