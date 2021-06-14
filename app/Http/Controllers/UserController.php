<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Config;

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
             $userRole = Auth::user()->role;
             return redirect()->route('home',['domain' => $userRole]);
         }else{
             return redirect()->route('login')->with('fail','Incorrect credentials');
         }
    }

    function logout()
    {
        // $url = request()->getHttpHost();
        // $url_server = explode('.',$url);
        // $subdomain = $url_server[0];

        // if($subdomain == 'www'){
        //     $subdomain = $url_server[1];
        // }

        // Auth::guard('web')->logout();
        // //config(['app.url' => 'http://localhost:8000/login']);
        // //echo config('app.url');
        // return redirect(config('app.local_url'));
        // $a = url()->current('http://localhost:8000/login');
        // echo $a."<br>";
        // echo url()->previous()."<br>";
        // $b = env('APP_URL', 'http://localhost:8000/login');
        //$a = config()->set('app.url', 'http://localhost:8000/login');
    
        //return Request::getHost();

        //return Auth::check();

        //return "jdgfahijahfuig";

        Auth::guard('web')->logout();

        return redirect('/');
        //return Route::domain(env('LOCAL_URL'));
    }
}
