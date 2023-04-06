<form action="<?php echo route('form.store') ?>" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <p>Username</p>
    <div>
        <input type="text" name="username">
    </div>
    <p>Password</p>
    <div>
        <input type="password" name="password">
    </div>
    <br>
    <div>
        <button type="submit">Login</button>
    </div>

</form>
