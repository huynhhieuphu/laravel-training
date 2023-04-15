@extends('layout')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <h1>{{ $title }}</h1>

    @if(session('msg_success'))
        <div class="alert alert-success">{{ session('msg_success') }}</div>
    @endif

    @if(session('msg'))
        <div class="alert alert-danger">{{ session('msg') }}</div>
    @endif

    <form action="">
        <div class="row">
            <div class="col-3">
                <select name="group" id="group" class="form-control">
                    <option value="">All Groups</option>
                    @if(!empty($listGroup))
                        @foreach($listGroup as $group)
                            <option
                                value="{{ $group->group_id }}" {{ request()->query('group') == $group->group_id ? 'selected' : false }}>{{ $group->group_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-3">
                <select name="status" id="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="active" {{ request()->query('status') == 'a' ? 'selected' : false }}>Active
                    </option>
                    <option value="inactive" {{ request()->query('status') == 'u' ? 'selected' : false }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="col-4">
                <input type="text" name="keyword" class="form-control" placeholder="Search keyword..."
                       value="{{ request()->query('keyword') }}">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    <a href="{{ route('dashboard.users.create') }}" target="_self" class="btn btn-success mt-2">Add User</a>
    <a href="{{ route('dashboard.users.trash') }}" target="_self" class="btn btn-secondary mt-2">Trash</a>
    <table class="table table-border my-2">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th><a href="?s=firstname&o={{ $o }}"
                   class="text-default d-flex justify-content-between align-items-center">Firstname {!! request()->query('s') == 'firstname' ? '<i class="fa fa-sort-'. request()->query('o') .'" aria-hidden="true"></i>' : false !!}</a>
            </th>
            <th><a href="?s=lastname&o={{ $o }}"
                   class="text-default d-flex justify-content-between align-items-center">Lastname {!! request()->query('s') == 'lastname' ? '<i class="fa fa-sort-'. request()->query('o') .'" aria-hidden="true"></i>' : false !!}</a>
            </th>
            <th><a href="?s=email&o={{ $o }}"
                   class="text-default d-flex justify-content-between align-items-center">Email {!! request()->query('s') == 'email' ? '<i class="fa fa-sort-'. request()->query('o') .'" aria-hidden="true"></i>' : false !!}</a>
            </th>
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
                    <td>{!! $user->user_status == 1 ? '<span class="badge badge-pill badge-success">Active</span>' : '<span class="badge badge-pill badge-secondary">Inactive</span>' !!}</td>
                    <td class="d-flex">
                        <form action="{{route('dashboard.users.remove')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                        <a href="{{route('dashboard.users.edit', ['id' => $user->user_id])}}" target="_self" class="btn btn-sm btn-info mx-1">Edit</a>
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
    {{ $users->links() }}
@endsection
