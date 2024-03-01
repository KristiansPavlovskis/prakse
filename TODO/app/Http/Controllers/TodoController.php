<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\User;

class TodoController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $todos = $user->todos()->get(); 
    $groups = $user->groups()->get();  


    return view('todos.index', [
        'todos' => $todos,
        'groups' => $groups,
        'user' => $user
    ]);
}



public function create()
{
    $user = Auth::user();
    $groups = $user->groups()->get();
    return view('todos.create', ['groups' => $groups]);
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
        $todo = $user->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => false,
            'priority' => 0,
            'group_id' => $request->group_id,
        ]);
    
        $groupId = $request->group_id;
        session()->flash('alert-success-' . $groupId, 'Todo successfully created!');

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

        session()->flash('alert-success-' . $group->id, 'Group successfully created!');

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

    public function update(Request $request)
{
    $todo = Todo::find($request->todo_id);
    $todo->update([
        'title' => $request->title,
        'description' => $request->description
    ]);
    $request->session()->flash('alert-info', 'Todo Updated Successfully');

    return redirect()->route('todos.index');
}

public function destroy($id)
{
    $todo = Todo::find($id);
    
    if (!$todo) {
        // Handle case where todo is not found
        if (request()->expectsJson()) {
            return response()->json([
                'status' => 404,
                'message' => 'Todo id not found',
            ], 404);
        }

        return back()->withErrors(['error' => 'Unable to locate the Todo']);
    }

    // Delete the todo
    $todo->delete();

    if (request()->expectsJson()) {
        return response()->json([
            'status' => 200,
            'message' => 'Todo is successfully deleted',
        ], 200);
    }

    return redirect()->route('todos.index');
}


    public function destroyGroup($id)
{
    $group = Group::find($id);
    if ($group) {
        $group->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 200,
                'message' => 'Group deleted successfully',
            ], 200);
        }

        return redirect()->route('todos.index');
    } else {
        if (request()->expectsJson()) {
            return response()->json([
                'status' => 404,
                'message' => 'Group not found',
            ], 404);
        }

        return back()->withErrors(['error' => 'Unable to locate the group']);
    }
}

public function complete(Request $request, $id)
{
    $todo = Todo::findOrFail($id);
    $todo->update([
        'is_completed' => !$todo->is_completed,
    ]);

    $request->session()->flash('alert-success', 'Todo status updated successfully');

    return redirect()->route('todos.index');
}
public function updatePriority(Request $request, $id)
{
    $todo = Todo::findOrFail($id);
    $priority = ($todo->priority + 1) % 3;
    
    $todo->update([
        'priority' => $priority
    ]);
    
    $request->session()->flash('alert-info', 'Todo Priority Updated Successfully');
    
    return redirect()->route('todos.index');
}



public function shareTodoWithUser(Request $request, $todoId)
{
    // Retrieve the target user ID from the request
    $targetUserId = $request->input('user_id');

    // Find the todo by ID
    $todo = Todo::findOrFail($todoId);

    // Share the todo with the target user
    $todo->sharedUsers()->attach($targetUserId);

    // Clone the todo for the shared user
    $sharedTodo = $todo->replicate();
    $sharedTodo->user_id = $targetUserId;

    // Check if the "Shared" group exists for the target user
    $sharedGroup = Group::where('name', 'Shared')->where('user_id', $targetUserId)->first();
    if (!$sharedGroup) {
        // If the group doesn't exist, create it
        $sharedGroup = Group::create([
            'user_id' => $targetUserId,
            'name' => 'Shared',
        ]);
    }
    $sharedTodo->group_id = $sharedGroup->id;
    $sharedTodo->parent_id = $todo->id; // Set the parent_id for the shared todo
    $sharedTodo->save();

    // Return the todo ID in the response
    return response()->json(['todo_id' => $todoId, 'message' => 'Todo shared successfully']);
}

public function unshareTodoWithUser(Request $request, $todoId)
{
    $user_id = $request->input('user_id');

    // Find the shared todo
    $todo = Todo::findOrFail($todoId);

    // Detach the specified user from the shared todo
    $todo->sharedUsers()->detach([$user_id]);

    // Check if the todo is a child todo
    if ($todo->parent_id !== $todo->id) {
        // If it's not a child todo, return response without deleting it
        return response()->json(['message' => 'Shared todo unshared successfully']);
    }

    return response()->json(['message' => 'Shared todo unshared successfully']);
}
















    
}
