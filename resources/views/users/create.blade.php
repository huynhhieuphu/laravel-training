@extends('layout')

@section('title')
    {{$title}}
@endsection

@section('content')
    <h1>{{ $title }}</h1>
    @if(session('msg'))
        <div class="alert alert-danger">{{ session('msg') }}</div>
    @endif

    <form action="{{ route('dashboard.users.add') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_firstname">First name</label>
            <input type="text" class="form-control" name="user_firstname" value="{{ old('user_firstname') }}">
            <span class="text text-danger">@error('user_firstname') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <label for="user_lastname">Last name</label>
            <input type="text" class="form-control" name="user_lastname" value="{{ old('user_lastname') }}">
            <span class="text text-danger">@error('user_lastname') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <label for="user_email">Email</label>
            <input type="text" class="form-control" name="user_email" value="{{ old('user_email') }}">
            <span class="text text-danger">@error('user_email') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <label for="user_group_id">Group</label>
            <select name="user_group_id" class="form-control">
                <option value="">Please choose group</option>
                @if(!empty($listGroup))
                    @foreach($listGroup as $group)
                        <option value="{{ $group->group_id }}" {{ old('user_group_id') == $group->group_id ? 'selected' : false }}>{{ $group->group_name }}</option>
                    @endforeach
                @endif
            </select>
            <span class="text text-danger">@error('user_group_id') {{ $message }} @enderror</span>
        </div>
        <div class="form-group">
            <label for="user_status">Status</label>
            <select name="user_status" class="form-control">
                <option value="">Please choose status</option>
                <option value="1" {{ old('user_status') == 1 ? 'selected' : false }}>Active</option>
                <option value="0" {{ old('user_status') == 0 ? 'selected' : false }}>InActive</option>
            </select>
            <span class="text text-danger">@error('user_status') {{ $message }} @enderror</span>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
        <a href="{{route('dashboard.users.index')}}" target="_self" class="btn btn-outline-secondary">Back</a>
    </form>
@endsection
