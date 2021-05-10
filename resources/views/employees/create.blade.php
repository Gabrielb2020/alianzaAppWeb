@extends('layouts.app')

@section('content')
<div class="container">

    <form method="POST" action="{{ url('/employees') }}">
        @csrf
        @include('employees.form',['mode'=>'Register'])
    </form>
    
</div>
@endsection