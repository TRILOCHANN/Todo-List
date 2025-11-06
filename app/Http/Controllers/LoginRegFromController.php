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

    public function varificationVerify(EmailVerificationRequest $request){
        $request->fulfill();
        return redirect()->route('login')->with('Success','Successfully Register !');
        return view('auth.verify-email');
    }

    //validation Loin
    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard');
        }else{
                return redirect()->route('/');
        }
    }
    
    
    //Show all tasks in your todo 
    public function showdata()
    {
        $tasks = TodoList::get();
        return view('dashboard',compact('tasks'));
    }

    //Store Tasks
    public function storetask(FormRequest $request)
    {
     
        TodoList::create([
                'description'=>$request->AddNewTask,
                
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
