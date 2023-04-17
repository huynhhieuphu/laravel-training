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
            <h1>Create Post</h1>
            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="post_title">Title</label>
                    <input type="text" name="post_title" class="form-control" value="{{ old('post_title') ?? '' }}">
                    <span class="text-danger">@error('post_title') {{ $message }} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="post_content">Content</label>
                    <textarea name="post_content" rows="10" class="form-control">{{ old('post_content') ?? '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Add</button>
                <a href="{{ route('post.index') }}" class="btn btn-outline-secondary">Back</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
