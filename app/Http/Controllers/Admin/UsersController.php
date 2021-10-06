<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Validator;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Rules\MatchOldPassword;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.users.users');
    }
    public function load()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::where('isRemove', 0)->latest()->get();
        return view('admin.users.loadusers', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all()->pluck('title', 'id');
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('roles');
        return view('admin.users.modalshow', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');
        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        User::find($user->id)->delete();
           
        return response()->json(['success' => 'User Removed Successfully.']);
    }

    public function usershow(User $user)
    {
        return view('admin.users.usershow', compact('user'));
    }

    public function userupdate(Request $request, User $user){
      
           

            date_default_timezone_set('Asia/Manila');
            $validated =  Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255' ],
                'current_password' => ['nullable',new MatchOldPassword],
                'new_password' => ['nullable'],
                'confirm_password' => ['nullable','same:new_password'],
               
            ]);
    
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }
    
            User::find($user->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('new_password'),
              
            ]);
            return response()->json(['success' => 'User Updated Successfully.']);
        
    }
}
