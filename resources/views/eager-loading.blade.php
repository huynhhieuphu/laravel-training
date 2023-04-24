<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo Eager Loading</title>
</head>
<body>
    <h1>Demo Eager Loading</h1>
    @foreach($posts as $post)
        <h2>{{ $post->post_name }}</h2>
        <h4>Author: {{ $post->user->user_name }}</h4>
{{--        <h4>Avatar: {{ $post->user->avatar->avatar_url }}</h4>--}}
{{--        <h5>Count Cate: {{ $post->categories_count }}</h5>--}}
{{--        <ul>--}}
{{--        @foreach($post->categories as $category)--}}
{{--            <li>{{ $category->category_name }}</li>--}}
{{--        @endforeach--}}
        </ul>
    @endforeach
</body>
</html>
