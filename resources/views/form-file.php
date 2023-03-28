<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Request File</title>
</head>
<body>

<form action="<?php echo route('form.handle.file') ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
    <input type="file" name="avatar">
    <button type="submit">Upload file</button>
</form>

</body>
</html>
