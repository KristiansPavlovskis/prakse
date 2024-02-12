@extends('layout')
@section('title', 'Login')
@section('content')
<div class="container mt-5">
    @if($errors->any())
    <div class="col-12">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
        @endforeach
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif

    <form action="{{route('login.post')}}" method="POST" class="ms-auto me-auto mt-3 bg-slate-300 p-4 rounded" style="max-width: 500px;">
        @csrf
        <div class="mb-3">
            <label class="form-label fs-5">Email address</label>
            <input type="email" class="form-control fs-6" name="email" placeholder="example@example.com">
        </div>
        <div class="mb-3">
            <label class="form-label fs-5">Password</label>
            <input type="password" class="form-control fs-6" name="password" placeholder="password123">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block bg-blue-500">Submit</button>
    </form>
</div>
@endsection
