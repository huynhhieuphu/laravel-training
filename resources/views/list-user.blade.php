@extends('layouts.app')

@section('title') {{ $title ?? '' }}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('home') }}">Back</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List User</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-border">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>email</th>
                                <th>edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($users))
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><a href="">Edit</a></td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
