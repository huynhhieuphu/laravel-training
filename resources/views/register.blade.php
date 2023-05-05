@extends('layouts.app')

@section('title') {{ $title ?? '' }} @endsection

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Sign Up Form</h4>
                    </div>

                    @if($errors->any())
                        <ul class="alert alert-danger mx-3 my-3">
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    @if(!empty(session('fail')))
                        <div class="alert alert-danger mx-3 my-3">{{ session('fail') }}</div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('register.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control"
                                       value="{{ old('username') ?? false }}">
                                <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') ?? false }}">
                                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                <span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <a href="{{ route('login.form') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
