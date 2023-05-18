@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>List Comment</div>
                            @can('create', App\Models\Comment::class)
                                <a href="#" class="btn btn-success btn-sm">create</a>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Content</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($comments))
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td scope="row">{{ $comment->id }}</td>
                                            <td>{{ $comment->content }}</td>
                                            <td>
                                                {{-- @can('update', $comment)
                                                    <a href="#" class="btn btn-success btn-sm">Edit</a>
                                                @endcan --}}

                                                {{-- @cannot('update', $comment)
                                                    <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                                @endcannot --}}

                                                @can('update', $comment)
                                                    <a href="#" class="btn btn-success btn-sm">Edit</a>
                                                @else
                                                    <a href="#" class="btn btn-secondary btn-sm">Show</a>
                                                @endcan

                                            </td>
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
