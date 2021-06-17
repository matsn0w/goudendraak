<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::with('roles')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // validate the request
        $validated = $request->validated();

        // find the selected roles
        $roles = Role::whereIn('id', $validated['checked'])->get();

        // create the new user
        $user = User::create([
            'code' => $validated['code'],
            'password' => Hash::make($validated['password']),
        ]);

        // save roles to the user
        $user->roles()->attach($roles);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::with('roles')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        // validate the request
        $validated = $request->validated();

        // find the user
        $user = User::findOrFail($id);

        // find the selected roles
        $roles = Role::whereIn('id', $validated['checked'])->get();

        // update the user
        $user->update($validated);

        // update password if filled
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
            $user->save();
        }

        // synchronize the user's roles
        $user->roles()->sync($roles);

        return new UserResource($user->load('roles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the user
        $user = User::findOrFail($id);

        // delete the user's roles
        $user->roles()->sync([]);

        // delete the user
        $user->delete();

        return response()->json(null, 204);
    }
}
