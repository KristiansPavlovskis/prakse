@extends('layout')
@section('title', "Home Page")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-slate-500 text-white">Create your Group</div>

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
                <form method="post" action="{{ route('todos.storeGroup') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" name="name">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary bg-slate-500 border-none">Submit</button>
                </form>


                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


