<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eloquent ORM - CURD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if(session()->has('msg'))
                <div class="alert alert-success">{{ session('msg') }}</div>
            @endif

            <h1>Archive Post</h1>
                <a href="{{route('post.index')}}" class="btn btn-primary">List Post</a>
            <table class="table table-border">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Publish</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($posts))
                    @php
                        $i = 1;
                    @endphp
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $post->post_title }}</td>
                            <td>{{ $post->post_publish }}</td>
                            <td>
                                <form action="{{ route('post.delete', ['id' => $post->post_id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <form action="{{ route('post.restore', ['id' => $post->post_id]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Restore</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
