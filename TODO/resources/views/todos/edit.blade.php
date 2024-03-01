@extends('layout')
@section('title', "Home Page")
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-slate-500 text-white">Edit Todo</div>

                <div class="card-body">
                    <form method="post" action="{{route('todos.update')}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="todo_id" value="{{$todo->id}}">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{$todo->title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" cols="5" rows="5">
                            {{$todo->description}}
                            </textarea>
                        </div>
            
                        <button type="submit" class="btn btn-primary bg-slate-500 border-none">Update</button>
                    </form>

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

