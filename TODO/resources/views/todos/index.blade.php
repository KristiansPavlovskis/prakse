@extends('layout')
@section('title', "Home Page")

@section('content')
@foreach ($groups as $group)
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header bg-secondary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-0">{{ $group->name }}</h2>
                    </div>
                    <div>
                    <counter :group-id="{{ $group->id }}"></counter>
                    </div>
                </div>
                
                  
            </div>


            <div class="card-body">
                    @if(Session::has('alert-success-' . $group->id)) <!-- Adjust the session key -->
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('alert-success-' . $group->id) }}
                    </div>
                    @endif

                    <!-- Display delete notification -->
                    @if(Session::has('alert-delete-' . $group->id))
                    <div class="alert alert-info" role="alert">
                        {{ Session::get('alert-delete-' . $group->id) }}
                    </div>
                    @endif

               

                    <a class="btn btn-lg btn-secondary  mx-auto mb-3" href="{{route('todos.create')}}">Create Todo</a>
                    
                    @if($group->todos && $group->todos->isNotEmpty()) 
                        
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Completed</th>
                                    <th>priority</th>
                                    <th>Actions</th>
                                    <th>Share</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($group->todos as $todo)
                                    <tr>
                                        <td>{{ $todo->title }}</td>
                                        <td>{{ $todo->description }}</td>
                                        <td>
                                        <completion :todo-id="{{ $todo->id }}" :initial-completed="{{ $todo->is_completed ? 'true' : 'false' }}" :todo="{{ json_encode($todo) }}"></completion>
                                        </td>
                                        <td>
                                        <priority :todo-id="{{ $todo->id }}" :initial-priority="{{ $todo->priority }}" :todo="{{ json_encode($todo) }}"></priority>
                                        </td>
                                        
                                        <td class="d-flex" id="app">
                                            <a class="btn btn-sm btn-info" href="{{route('todos.edit', $todo->id)}}">Edit</a>
                                            <form method="post" class="inline-block" action="{{ route('todos.destroy', $todo->id) }}">
                                                @csrf 
                                                <todo-list :todo-id="{{ $todo->id }}"></todo-list>
                                            </form>
                                        </td>
                                        <td>
                                            <share :todo-id="{{ $todo->id }}" :group-id="{{ $group->id }}" ></share>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h4 class="mt-3">No todos are created yet.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<div style="position: fixed; right: 30px; bottom: 30px;">
<a class="btn btn-lg btn-secondary text-xl px-6 py-3" href="{{route('todos.createGroup')}}">Create Group</a>
</div>
@endsection

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
