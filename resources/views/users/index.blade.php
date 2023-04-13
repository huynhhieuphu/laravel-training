@extends('layout')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <h1>{{ $title }}</h1>
                <form action="">
                    <div class="row">
                        <div class="col-3">
                            <select name="group" id="group" class="form-control">
                                <option value="">All Groups</option>
                                @if(!empty($listGroups))
                                    @foreach($listGroups as $group)
                                        <option value="{{ $group->group_id }}" {{ request()->query('group') == $group->group_id ? 'selected' : false }}>{{ $group->group_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="status" id="status" class="form-control">
                                <option value="">All Status</option>
                                <option value="a" {{ request()->query('status') == 'a' ? 'selected' : false }}>Active</option>
                                <option value="u" {{ request()->query('status') == 'u' ? 'selected' : false }}>Unactive</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input type="text" name="keyword" class="form-control" placeholder="Search keyword..." value="{{ request()->query('keyword') }}">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
                <table class="table table-border my-2">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th><a href="?column=user_firstname&direction={{ $direction }}" class="text-default justify-content-between d-flex align-items-center">Firstname {!! request()->query('column') == 'user_firstname' ? '<i class="fa fa-sort-'. request()->query('direction') .'" aria-hidden="true"></i>' : false !!}</a></th>
                            <th><a href="?column=user_lastname&direction={{ $direction }}" class="text-default justify-content-between d-flex align-items-center">Lastname {!! request()->query('column') == 'user_lastname' ? '<i class="fa fa-sort-'. request()->query('direction') .'" aria-hidden="true"></i>' : false !!}</a></th>
                            <th><a href="?column=user_email&direction={{ $direction }}" class="text-default justify-content-between d-flex align-items-center">Email {!! request()->query('column') == 'user_email' ? '<i class="fa fa-sort-'. request()->query('direction') .'" aria-hidden="true"></i>' : false !!}</a></th>
                            <th>Group</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($users))
                            @php
                            $i = 1;
                            @endphp
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$user->user_firstname}}</td>
                                    <td>{{$user->user_lastname}}</td>
                                    <td>{{$user->user_email}}</td>
                                    <td>{{$user->group_name}}</td>
                                    <td>{!! $user->user_status == 1 ? '<span class="badge badge-pill badge-success">Active</span>' : '<span class="badge badge-pill badge-secondary">Unactive</span>' !!}</td>
                                    <td>
                                        <a href="" target="_self" class="btn btn-sm btn-danger">Delete</a>
                                        <a href="" target="_self" class="btn btn-sm btn-info">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">NO DATA</td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
