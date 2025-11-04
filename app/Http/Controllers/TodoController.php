<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
        public function index(){
                return view('welcome');
        }

        public function store(Request $request){
                $request->validate(['AddNewTask'=>'required|string']);
                $tasks = DB::table('todo_lists')
                ->insert([
                        'description'=>$request->AddNewTask,
                ]);
                return back();
                
        }

        public function show(){
                $tasks = TodoList::get();
                return view('dashboard',compact('tasks'));
        }

        public function delete(string $id){
                $dataDelete = DB::table('todo_lists')
                ->where('id',$id)
                ->delete();
                return back();
        }

        public function Edit(string $id){
                $todo = TodoList::where('id',$id)
                ->first();
                return view('todo-update',compact('todo'));
        }
        public function updated(Request $request ,$id){
                $SaveUpdate = DB::table('todo_lists')
                ->where('id',$id)
                ->update([
                        'description'=> $request->AddNewTask,
                ]);
                return back();
            
        }


        
        
        
}


