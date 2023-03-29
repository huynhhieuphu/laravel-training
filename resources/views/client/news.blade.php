@extends('client.master-layout')

@section('title')
    News Page
@endsection

@section('parent')
    Ghi đè
@endsection

@section('content')
    <h3>This is content News</h3>
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
