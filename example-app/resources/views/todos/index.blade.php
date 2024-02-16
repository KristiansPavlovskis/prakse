@extends('layout')
@section('title', "Home Page")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h2 class="mb-0">{{ __('Todo Saraksts')}}</h2>
                </div>
                <div class="card-body">
                    @if (Session::has('alert-success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('alert-success')}}
                        </div>
                    @endif

                    @if (Session::has('alert-info'))
                        <div class="alert alert-info" role="alert">
                            {{ Session::get('alert-info')}}
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error')}}
                        </div>
                    @endif

                    <a class="btn btn-lg btn-secondary  mx-auto mb-3" href="{{route('todos.create')}}">Create Todo</a>
                    <a class="btn btn-lg btn-secondary float-right mb-3" href="#">
                        <i class="fa-solid fa-share"></i> Share
                    </a>
            <!-- Šeit arī if else priekš group, ja group nav tad pārējais nērādās un ja izveido group tad rādīsies tas no todos created yet -->
                    @if(count($todos) > 0)
                        <table class="table table-bordered" id="app">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Completed</th>
                                    <th>priority</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $todo)
                                    <tr>
                                        <td>{{ $todo->title }}</td>
                                        <td>{{ $todo->description }}</td>
                                        <td>
                                            @if ($todo->is_completed == 1)
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-danger">Not Completed</span>
                                            @endif
                                        </td>
                                        <td>
                                        @if ($todo->priority == 1)
                                                <span class="badge bg-info">medium</span>
                                        @elseif ($todo->priority == 0)
                                                <span class="badge bg-success">low</span>
                                            @else
                                                <span class="badge bg-danger">high</span>
                                            @endif
                                        </td>
                                        <td class="d-flex">
                                        <a class="btn btn-sm btn-info" href="{{route('todos.edit', $todo->id)}}">Edit</a>
                                            <form method="post" class="inline-block" action="{{ route('todos.destroy', $todo->id) }}">
                                                @csrf 
                                                <todo-list :todo-id="{{ $todo->id }}" class="btn btn-danger"></todo-list>
                                            </form>
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
<div style="position: fixed; right: 30px; bottom: 30px;">
<a class="btn btn-lg btn-secondary text-xl px-6 py-3" href="#">Create Group</a>
</div>
@endsection
@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection