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

                    @if(count($todos) > 0)
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Completed</th>
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
                                        <td class="d-flex">
                                            <form action="{{ route('todos.destroy') }}" method="post">
                                                @csrf
                                                <a href="{{ route('todos.show', $todo->id) }}" class="me-3"><i class="fas fa-eye text-success fa-lg"></i></a>
                                                <a href="{{ route('todos.edit', $todo->id) }}" class="me-3"><i class="fas fa-edit text-info fa-lg"></i></a>
                                                <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-danger"><i class="fas fa-trash-alt fa-lg"></i></button>
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
@endsection
