<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validation - Create Rule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <h1>{{ $title }}</h1>

            <form action="{{ '/comment' }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="comment_name">Name</label>
                    <input type="text" name="comment_name" class="form-control">
                    @error('comment_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="comment_email">Email</label>
                    <input type="text" name="comment_email" class="form-control">
                    @error('comment_email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="comment_message">Message</label>
                    <textarea name="comment_message" class="form-control" rows="5"></textarea>
                    @error('comment_message') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-success">Send</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
