<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{--    <h2><?php echo $title ?></h2>--}}

    <h2>{{ $title }}</h2>
    <hr>

    {{ $content }}
    <hr>

    {!!$content !!}
    <hr>

    {{ (true) ? 'Điều kiện true' : '' }}
    <br>
    {!! (true) ? 'Điều kiện true' : '' !!}
    <hr>

    @if(true)
        Điều kiện true
    @endif
    <br>

    @if(false)
        Điều kiện true
    @else
        Điều kiện false
    @endif
    <br>

    @php
        $point = 8;
    @endphp

    @if($point > 8 && $point <= 10)
        học sinh giỏi
    @elseif($point > 6 && $point <= 8)
        học sinh khá
    @elseif($point > 4 && $point <= 6)
        học sinh trung bình
    @elseif($point > -1 && $point <= 4)
        học sinh kém
    @else
        điểm thi không hợp lệ
    @endif
    <hr>

    @switch($point)
        @case(10)
        @case(9)
            học sinh giỏi
            @break
        @case(8)
        @case(7)
            học sinh khá
            @break
        @case(5)
        @case(6)
            học sinh trung bình
            @break
        @case(4)
        @case(3)
        @case(2)
        @case(1)
        @case(0)
            học sinh kém
            @break
        @default
            không hợp lệ
            @break
    @endswitch
    <hr>

    @for($i = 0; $i <= 10; $i++)
        index: {{ $i }} <br>
    @endfor
    <br>

    @php $count = 1; @endphp
    @while($count <= 10)
        count: {{ $count }} <br>
        @php $count++; @endphp
    @endwhile
    <hr>

    @if(!empty($categories))
        <ul>
        @foreach($categories as $category)
            <li id="{{$category['id']}}">{{$category['name']}}</li>
        @endforeach
        </ul>
    @endif
    <br>

    @if(isset($products))
        <ul>
            @forelse($products as $product)
                DATA
            @empty
                NO DATA
            @endforelse
        </ul>
    @endif
    <hr>

    @{{varJSframework}}

    @verbatim
    <div>
        <div>{{varJSframework}}</div>
    </div>
    @endverbatim
</body>
</html>
