@extends('App.layout')
@section('content')
<div>

    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
    <h1>about us</h1>
    <h2> your name is {{ $name }}</h2>
    <h2>your id is {{ $id }}</h2>
    @include('subview.input',['myName'=>$name

    ])

</div>
@endsection
{{-- comment

@for($i = 0; $i < 10; $i++)
<p>this is {{ $i }}</p>

@if ($i==5)
 <p>this is {{ $i }} </p>
@endif

@endfor
--}}

