<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Roles;
use App\User;
use App\Role;

use App\Http\Traits\RoleTrait;

class UserController extends Controller
{
    use RoleTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = Request::create('/api/user', 'GET');
        
        // $response = Route::dispatch($request);
        $response = app()->handle($request)->getData();
        
        $data = User::all();

        return view('usersmanagement.index')
            // ->with('users', $response->data)
            ->with('users', $data);
    }
    
    public function assignRole(Request $request){
        
        // Find role id with given text
        $role_id = Role::findBySlug('admin');

        User::find($request->user_id)->roles()->attach($role_id);

        // 1 is admin, 2 is normal user
        // User::find($request->user_id)->roles()->attach(1);

        return back();
        
    }

    public function revokeRole(Request $request){
        
        User::find($request->user_id)->roles()->detach(1);
        
        return back();
    }
    
    public function all(){
        return $this->allRoles();
    }

    public function roles(){
        return dd(User::find(1)->Roles());
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
