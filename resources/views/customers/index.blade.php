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
                @if(session('suc_message'))
                    <div class="alert alert-success">{{ session('suc_message') }}</div>
                @endif

                @if(session('err_message'))
                    <div class="alert alert-danger">{{ session('err_message') }}</div>
                @endif

                <a href="{{ route('customer.create') }}" class="btn btn-success" target="_self">Add Customer</a>
                <table class="table table-border my-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @forelse($customers as $customer)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $customer->customer_fullname }}</td>
                            <td>{{ $customer->customer_email }}</td>
                            <td class="d-flex">
                                <form action="{{ route('customer.delete') }}" method="post" class="mr-1">
                                    @csrf
                                    <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Ban co chac khong ?')">Delete</button>
                                </form>
                                <a href="{{ route('customer.edit', ['id' => $customer->customer_id]) }}" class="btn btn-primary" target="_self">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">NO DATA</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
