<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validation - Form Request</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <h1>{{ $title }}</h1>

{{--            @if($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <p>{{ $errorMessage }}</p>--}}
{{--                </div>--}}
{{--            @endif--}}

            @error('errMessage')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <form action="{{ '/product/create' }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="product_name">Name</label>
                    <input type="text" name="product_name" class="form-control">

                    @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_order">Order</label>
                    <input type="text" name="product_order" class="form-control">

                    @error('product_order')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
