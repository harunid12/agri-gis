<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        return view('user.profile', ['user' => $user]);
    }

    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $request->validate([
            'no_hp' => 'required|max:13',
            'email' => 'required|email|max:50|unique:users,email,' . $user->id,
            'username' => 'required',
            'password' => ($request->filled('password')) ? 'max:255|min:7' : 'nullable',
        ]);

        // jika mengganti password dan keseluruhan data
        if ($request['password']){
            $password = Hash::make($request->password);
            
            $user->update([
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $password
            ]);
        }else{
            $user->update([
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'username' => $request->username,
            ]);
        }
        
        return back()->with('toast_success', 'data profile berhasil diubah');
    }
}
