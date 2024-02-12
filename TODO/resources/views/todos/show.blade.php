@extends('layout')
@section('title', "Home Page")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-auto ">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header bg-slate-500 text-white">{{ __('Your Todo')}}</div>

                <div class="card-body">

                @if (Session::has('alert-success'))
                <div class="alert alert-success" role="alert">
                    {{ Session('status')}}
                </div>
                @endif
                    <a href="{{url()->previous()}}" class="btn btn-sm btn-info bg-slate-500 text-white border-none">Go Back</a> <br>
                <b>Your Todo title is:</b> {{$todo->title}} <br>
                <b>Your Todo description is:</b> {{$todo->description}}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
