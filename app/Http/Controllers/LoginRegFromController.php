<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\EmailModel;
use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


class LoginRegFromController extends Controller
{
    //login form
    public function loginform()
    {
            return view('login');
    }
    //registration form
    public function registerform()
    {
            return view('registration');
    }
    
    //Store Login&Registration Data
    public function store(FormRequest $request)
    {
        $validateUser = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
        ]);
        event(new Registered($validateUser));

        Auth::login($validateUser);
        return redirect()->route('varification.notice');
    }

    public function varificationNotice(){
        return view('auth.verify-email');
    }

    public function varificationVerify(EmailVerificationRequest  $request){
        $request->fulfill();
        return redirect()->route('login');
        return view('auth.verify-email')->with('Success','Successfully Register !');
    }

    //validation Loin
    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Check if the user's email is verified
        if (!$user->hasVerifiedEmail()) {
            Auth::logout(); // Log out the user if not verified
            return back()->with('fail', 'Please verify your email before logging in.');
        }

        return redirect()->route('dashboard');
        } else {
            return back()->with('fail', 'Invalid credentials');
        }


    }
    
    
    //Show all tasks in your todo 
    public function showdata()
    {
        $data = TodoList::where('user_id',Auth::id())->get();
        return view('dashboard',compact('data'));
    }

    //Store Tasks
    public function storetask(FormRequest $request)
    {
     
        TodoList::create([
                'description'=>$request->AddNewTask,
                'user_id'=>Auth::id(),     
        ]);
        return back();
    }

    //Logout page
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    //Delete Tasks
    public function delete(string $id){
                TodoList::where('id',$id)
                ->delete();
                return back();
    }
    
    //Edit Tasks
    public function Edit(string $id){
                $todo = TodoList::where('id',$id)
                ->first();
                return view('todo-update',compact('todo'));
    }

    public function updated(Request $request ,$id){
                $SaveUpdate = TodoList::where('id',$id)
                ->update([
                        'description'=> $request->AddNewTask,
                ]);
                return redirect()->route('dashboard');
        }
       
    
}
