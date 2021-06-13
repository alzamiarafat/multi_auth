<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirmpassword' => 'required|same:password',
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
        ]);

        if ($user) {
            return redirect()->back()->with('success','You are now registered successfully');
        }else{
            return redirect()->back()->with('fail','Someting went wrong'); 
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|max:30'
         ],[
             'email.exists'=>'This email is not exists on users table'
         ]);
 
         $creds = $request->only('email','password');
         if( Auth::attempt($creds) ){
             return redirect()->route('user.home');
         }else{
             return redirect()->route('user.login')->with('fail','Incorrect credentials');
         }
    }

    function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
