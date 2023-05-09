<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail - Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-3">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center"><span class="text-danger">Laravel</span> Sending E-mail</h3>
                    </div>
                    <div class="card-body">

                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('send-mail') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" name="fullName" class="form-control" value="{{ old('fullName') ?? false }}">
                                <span class="text-danger">@error('fullName') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') ?? false }}">
                                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" value="{{ old('subject') ?? false }}">
                                <span class="text-danger">@error('subject') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" rows="4" class="form-control">{{ old('content') ?? false }}</textarea>
                                <span class="text-danger">@error('content') {{ $message }} @enderror</span>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
