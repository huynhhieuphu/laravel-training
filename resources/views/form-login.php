<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>flash, withInput, old</title>
</head>
<body>

<h1>flash, withInput, old</h1>

<h3><?php echo $oldUsername ?? '' ?></h3>

<form action="<?php echo route('form.handle.login') ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
    <p>Username</p>
    <div>
        <input type="text" name="username" value="<?php echo old('username') ?>">
    </div>
    <p>Password</p>
    <div>
        <input type="password" name="password">
    </div>
    <br>
    <button type="submit">Login</button>
</form>

</body>
</html>
