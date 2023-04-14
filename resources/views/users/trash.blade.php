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
    <a href="{{route('dashboard.users.index')}}" target="_self" class="btn btn-info mt-2">List User</a>
    <table class="table table-border my-2">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th><a href="?column=user_firstname&direction={{ $direction }}"
                   class="text-default d-flex justify-content-between align-items-center">Firstname {!! request()->query('column') == 'user_firstname' ? '<i class="fa fa-sort-'. request()->query('direction') .'" aria-hidden="true"></i>' : false !!}</a>
            </th>
            <th><a href="?column=user_lastname&direction={{ $direction }}"
                   class="text-default d-flex justify-content-between align-items-center">Lastname {!! request()->query('column') == 'user_lastname' ? '<i class="fa fa-sort-'. request()->query('direction') .'" aria-hidden="true"></i>' : false !!}</a>
            </th>
            <th><a href="?column=user_email&direction={{ $direction }}"
                   class="text-default d-flex justify-content-between align-items-center">Email {!! request()->query('column') == 'user_email' ? '<i class="fa fa-sort-'. request()->query('direction') .'" aria-hidden="true"></i>' : false !!}</a>
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
                        <form action="{{route('dashboard.users.delete')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                            <button type="submit" onclick="return confirm('Bạn có chắc không')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                        <form action="{{route('dashboard.users.rollback')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                            <button type="submit" class="btn btn-sm btn-primary ml-1">Rollback</button>
                        </form>
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
