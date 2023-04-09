<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validation - Ajax</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3  ">
            <h1 class="title">{{ $title }}</h1>
            <div class="alert alert-danger msg_error message_error" style="display: none"></div>
            <form action="{{ url('/login') }}" method="post" id="formLogin">
                @csrf
                <div class="form-group">
                    <label for="user_username">Username</label>
                    <input type="text" name="user_username" class="form-control">
                    <span class="text-danger msg_error user_username_error">@error('user_username')  {{ $message }} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="user_password">Password</label>
                    <input type="password" name="user_password" class="form-control">
                    <span class="text-danger msg_error user_password_error">@error('user_password') {{ $message }} @enderror</span>
                </div>
                <button type="submit" class="btn btn-success btnLogin">Login</button>
            </form>
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#formLogin').on('submit', function(e) {
           e.preventDefault();
           let username = $('input[name=user_username]').val().trim();
           let password = $('input[name=user_password]').val().trim();
           // validation client side
            let actionUrl = $(this).attr('action');
            let _token = $('input[name=_token]').val().trim();

            $.ajax({
                url : actionUrl,
                type : 'post',
                data : {
                    _token : _token,
                    user_username : username,
                    user_password : password,
                },
                dataType: 'json',
                beforeSend : function() {
                    $('.msg_error').text('');
                    $('.message_error').hide();
                },
                success : function(response) {
                    let flag = true;

                    if(response.hasOwnProperty('errors')) {
                        $('.message_error').show();
                        let messages = response.errors;
                        for(let key in messages) {
                            $('.'+ key +'_error').text(messages[key][0]);
                        }
                        flag = false;
                    }

                    if(flag) {
                        console.log('do something...');
                        console.log(response);
                    }
                },
            });
        });
    });
</script>

</body>
</html>
