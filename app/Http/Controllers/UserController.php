<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index', [
            'user' => User::find(auth()->user()->id)
        ]);
    }

    public function edit()
    {
        return view('settings.edit', [
            'user' => User::find(auth()->user()->id)
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if($request->password === null){
            $rules = [
                'name' => 'required|max:255',
                'address' => 'required|string',
                'phone_number' => 'required|numeric|min:10',
            ];
            
            if($request->email !== $user->email){
                $rules['email'] = 'required|email|unique:users';
            }
        } else {
            $rules = [
                'password' => 'nullable|string|min:8|confirmed'
            ];
        }

        $validatedData = $request->validate($rules);
        
        if(!empty($validatedData['password'])){
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $validatedData = array_filter($validatedData);
        
        $user->update($validatedData);

        Alert::success('Success', 'User Berhasil Diupdate')->persistent(false, false)->autoClose(3000);
        return redirect('/settings');
    }
}
