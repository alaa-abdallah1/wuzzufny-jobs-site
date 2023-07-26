<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // return $request;
        // $path = $request->file('avatar')->store('public/images/users');
        // $user->avatar = url($path);

        // $user->save();

        // return $user->avatar;

        $request->validate([
            'name' => 'required|min:4|max:30',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'job' => 'required',
            'gender' => 'required', Rule::in(['male', 'female']),
            'country' => 'required',
            'info' => 'required|min:200|max:1000',
            // 'avatar' => 'nullable|image|max:100000',
            'skills' => 'required',
        ]);
        $user->update($request->except('avatar'));
        if ($request->hasFile('avatar') && !empty($request->file('avatar'))) {
            if (!empty($user->avatar)) {
                $file_path = parse_url($user->avatar);
                Storage::disk('s3')->delete($file_path); // delete old pic
            }
            $path = $request->file('avatar')->store('images/users', 's3');
            $user->avatar = Storage::disk('s3')->url($path);
            $user->save();
        }
        return response()->json(['user' => $user, 'msg' => 'You updated your profile successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Return User's Jobs
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function userJobs()
    {
        return response()->json(Job::orderDesc()->where('user_id', Auth::id())->get(['id', 'name']));
    }
}