@extends('layout')
@section('title', "Home Page")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-slate-500 text-white">Todos App</div>

                <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="post" action="{{route('todos.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" cols="5" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                        <div class="mb-3">
                            <label class="form-label" for="group_id">Group</label>
                            <select name="group_id" class="form-control" id="group_id">
                                <option value="" disabled>Select a group</option>
                                @foreach($groups as $group)
                                    <option selected value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary bg-slate-500 border-none" >Submit</button>
                    </form>

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

