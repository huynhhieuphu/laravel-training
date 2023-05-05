@extends('layouts.app')

@section('title') {{ $title ?? '' }}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile: {{ auth()->user()->name ?? false }}</h4>
                    </div>
                    <div class="card-body">

                        @if(!empty(session('fail')))
                            <div class="alert alert-danger">{{ session('fail') }}</div>
                        @endif

                        @if(!empty(session('success')))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="post" action="{{ route('update-profile') }}">
                            @csrf
                            <div class="row my-1">
                                <div class="col-4">
                                    <label for="password">New Password</label>
                                </div>
                                <div class="col-8">
                                    <input type="password" class="form-control" name="password">
                                    @error('password') {{ $message }} @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('login.logout') }}">Logout</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
