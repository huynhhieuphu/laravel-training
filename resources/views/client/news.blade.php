@extends('client.master-layout')

@section('title')
    News Page
@endsection

@section('parent')
    Ghi đè
@endsection

@section('content')
    <h3>This is content News</h3>

    @datetime('30-03-2022 04:19:30 PM')

    @env('sandbox')
        <p>Môi trường Test</p>
    @elseenv('production')
        <p>Môi trường Product</p>
    @else
        <p>Môi trường Local</p>
    @endenv


@endsection

{{-- Nhúng css bằng yield --}}
@section('css')
    header {
        color : red;
    }
@endsection

{{-- nhúng js bằng yield --}}
@section('script')
    <script>
        // alert('This is script');
    </script>
@endsection
