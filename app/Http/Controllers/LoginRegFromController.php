<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;


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
        $storeValue = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
        ]);
        return redirect('/')->with('success','Successfully Registered');
    }

    //validation Loin
    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard');
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
        return view('login');
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
