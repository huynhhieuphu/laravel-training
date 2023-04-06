<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Laravel</title>
</head>
<body>

<img src="{{ asset('/downloadFile/What-is-Laravel.png')  }}">

<div>
    <a href="{{route('download.file') . '?d=' . public_path('/downloadFile/What-is-Laravel.png')}}">Download File</a>
    <br>
    <a href="{{route('download.file.word') . '?d=' . public_path('/downloadFile/03-Routing Laravel.docx')}}">Download File Word</a>
    <br>
    <a href="{{route('download.stream') . '?d=https://photo2.tinhte.vn/data/attachment-files/2023/04/6382958_Cover.jpg' }} ">Download Stream</a>
</div>

</body>
</html>
