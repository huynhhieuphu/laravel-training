<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>

    {{--  Nhúng bằng yield --}}
    <style>
        @yield('css')
    </style>

    {{--  Nhúng bằng stack  --}}
    @stack('myStyle')
</head>
<body>
    @include('client.partials.header')

    @include('client.partials.sidebar')

    @section('parent')
        <div>This is parent section</div>
    @show

    <main>
        @yield('content')
    </main>

    @include('client.partials.footer')

    {{--  Nhúng bằng yield --}}
    @yield('script')

    {{--  Nhúng bằng stack  --}}
    @stack('myScript')
</body>
</html>
