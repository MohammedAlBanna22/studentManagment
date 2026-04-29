@extends('App.layout')
@section('content')
<div>
    <!-- Order your soul. Reduce your wants. - Augustine -->
    <h1>Contact Us with view not get functi</h1>
    <h2> this name pass without get by view func {{ request()->  name }}</h2>
    <h2>this id is {{request()->id}}</h2>
    {{--
    this comment
     --}}
     @include('subview.input',['myName'=>request()->name,])

</div>
@endsection
