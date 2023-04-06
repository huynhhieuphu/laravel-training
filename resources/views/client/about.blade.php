@extends('client.master-layout')

@section('title')
    About Page
@endsection

@section('parent')
    @parent
    <div>Ghi tiếp tục bên dưới với @-parent</div>
@endsection

@section('content')
    <h3>This is content About</h3>

{{--    <x-package-alert />--}}

{{--    <h5>hoặc</h5>--}}

{{--    <x-package-alert></x-package-alert>--}}


{{--    <x-button />--}}

{{--    <h5>hoặc</h5>--}}

{{--    <x-inputs.button /> --}}

@endsection

@push('myStyle')
    <style>
        header {
            color: yellow;
            background-color: red;
        }
    </style>
@endpush

@push('myScript')
    <script>
        //alert('Nhung css/js bang stack - push');
    </script>
@endpush
