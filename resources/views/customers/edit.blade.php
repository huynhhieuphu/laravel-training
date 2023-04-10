<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start Database - Config, CURD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <h1>{{ $title }}</h1>

            @if($errors->any())
                <div class="alert alert-danger">{{ $error_validate }}</div>
            @endif

            @if(session('err_message'))
                <div class="alert alert-danger">{{ session('err_message') }}</div>
            @endif

            <form action="{{ route('customer.update') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="customer_fullname">Fullname</label>
                    <input type="text" name="customer_fullname" class="form-control" value="{{ old('customer_fullname') ?? $customer->customer_fullname }}">
                    <span class="text text-danger">@error('customer_fullname') {{ $message }} @enderror</span>
                </div>
                <div class="form-group">
                    <label for="customer_email">Email</label>
                    <input type="text" name="customer_email" class="form-control" value="{{ old('customer_email') ?? $customer->customer_email }}">
                    <span class="text text-danger">@error('customer_email') {{ $message }} @enderror</span>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('customer.list') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
