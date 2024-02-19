<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;


class TodoController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $todos = $user->todos()->get();
    $groups = Group::all(); // Retrieve all groups
    return view('todos.index', [
        'todos' => $todos,
        'groups' => $groups  // Pass $groups to the view
    ]);
}


    
    public function create()
{
    $group = Group::all();
    if ($group->isEmpty()) { 
        return redirect()->route('todos.createGroup');
    }

    return view('todos.create');
}


    public function createGroup(){
        return view('todos.createGroup');
    }
    function createGroupPost(Request $request){
        $request->validate([
            'name' => 'required'
        ]);
    }
    public function store(TodoRequest $request){
        $user = Auth::user();
        $user->todos()->create([
            'title' => $request->title,
            'description' =>$request->description,
            'is_completed' => 0,
            'priority' => 0
        ]);
        $todos = Todo::all();
        $request->session()->flash('alert-success', 'Todo Created Successfully');
    
        return redirect()->route('todos.index'); 
    }
    public function storeGroup(Request $request)
{
    $request->validate([
        'name' => 'required'
    ]);

    $user = Auth::user();
    $group = $user->groups()->create([
        'name' => $request->name
    ]);

    $request->session()->flash('alert-success', 'Group Created Successfully');

    return redirect()->route('todos.index');
}


    
    public function show($id){
        $todo = Todo::find($id);
        if(! $todo){
            request()->session()->flash('error', 'Unable to locate the Todo');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to locate the Todo'
            ]);
        }
        return view('todos.show', ['todo' => $todo]);
    }
    public function edit($id){
        $todo = Todo::find($id);
        if(! $todo){
            request()->session()->flash('error', 'Unable to locate the Todo');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to locate the Todo'
            ]);
        }
        return view('todos.edit', ['todo' => $todo]);
    }

    public function update(TodoRequest $request){
        $todo = Todo::find($request->todo_id);
        if(! $todo){
            request()->session()->flash('error', 'Unable to locate the Todo');
            return to_route('todos.index')->withErrors([
                'error'=> 'Unable to locate the Todo'
            ]);
        }
        $todo->update([
            'title' =>$request->title,
            'description' =>$request->description,
            'is_completed' =>$request->is_completed,
            'priority' =>$request->priority
        ]);
        $request->session()->flash('alert-info', 'Todo Updated Successfully');
        return redirect()->route('todos.index');
    }

    // public function destroy(Request $request){
    //     $todo = Todo::find($request->todo_id);
    //     if(! $todo){
    //         request()->session()->flash('error', 'Unable to locate the Todo');
    //         return to_route('todos.index')->withErrors([
    //             'error'=> 'Unable to locate the Todo'
    //         ]);
    //     }
    //     $todo->delete();
    //     $request->session()->flash('alert-success', 'Todo Deleted Successfully');
    //     return redirect()->route('todos.index');
    // }
    public function destroy($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->delete();
    
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Todo ir veiksmīgi izdzēsts',
                ], 200);
            }
    
            return redirect()->route('todos.index');
        } else {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Todo id nav atrasts',
                ], 404);
            }
    
            return back()->withErrors(['error' => 'Unable to locate the Todo']);
        }
    }
    

    

    
}
