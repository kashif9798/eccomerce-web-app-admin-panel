@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row @if (session('email-sent-success') || (isset($errors) && $errors->any()) || session()->has('success')) justify-content-between align-items-center @endif">
            <h1>Dashboard</h1>
            @if(session('email-sent-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('email-sent-success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ( $errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach    
                    </ul>
                    {{ session('status') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    <ul>
                        @foreach ( session()->get('success') as $message)
                            <li>{{$message}}</li>
                        @endforeach    
                    </ul>
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    
@endsection