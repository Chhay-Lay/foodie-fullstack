<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.profile.setting');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string',
            'old_password' => 'required|min:8',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (auth()->check()) {
            $user = User::find(auth()->user()->id);

            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'name' => $request->name,
                    'password' => Hash::make($request->new_password),
                ]);
                return redirect()->back()->with('alert', 'Your password is changed successfully');
            }else{
                return redirect()->back()->with('alert', 'Your password does not matched');
            }
        }
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
