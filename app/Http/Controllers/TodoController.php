<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function show(){
        return view('todo', ['todos'=>Todo::all(), 'todo'=>new Todo()]);
    }

    public function showid($id){
        return view('todo', ['todos'=>Todo::all(), 'todo'=>Todo::find($id)]);
    }

    public function delete($id){
        Todo::destroy($id);
        return redirect('/todos');

    }

    public function create(Request $request){
        if($request['id']!=''){
            $todo = Todo::find($request['id']);
            $todo->text = $request['text'];
            $todo->save();
            return redirect('/todos');
        }else {
            $todo = new Todo();
            $todo->text = $request['text'];
            $todo->save();
            return redirect('/todos');
        }
    }
}
