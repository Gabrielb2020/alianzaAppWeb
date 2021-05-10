@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('employees/'.$employee->id) }}" method="post">
        @csrf
        {{ method_field('PATCH')}}

<h1>Edit employee</h1>
<div class="form-row">
    <label>First Name</label>
    <input class="form-control" type="text" value="{{ isset($employee->first_name) ? $employee->first_name: '' }}" name="first_name" required>
</div>
<div class="form-row">
    <label>Last Name</label>
    <input class="form-control" type="text" value="{{ isset($employee->last_name) ? $employee->last_name : '' }}" name="last_name" required>
</div>
<div class="form-row">
    <label>Telephone</label>
    <input class="form-control" type="text" value="{{ isset($employee->telephone) ? $employee->telephone : '' }}" name="telephone" required>
</div>
<div class="form-row">
    <label>Identity Card</label>
    <input class="form-control" type="text"
    value=
        "@foreach($employee->identity_card as $identity_card)
            {{ isset($identity_card) ? $identity_card : '' }}
        @endforeach"
    name="identity_card" required>
</div>
<div class="form-row">
    <label>Address</label>
    <input class="form-control" type="text" 
    value=
    "@foreach($employee->address as $address)
    {{ isset($address) ? $address : '' }}
    @endforeach"
    name="address" required>
</div>
<div class="form-row">
    <label>Birth Data</label>
    <input class="form-control" type="text" 
    value="@foreach($employee->birth_data as $birth_data)
    {{ isset($birth_data) ? $birth_data : '' }}
    @endforeach"
    name="birth_data" required>
</div>

<div class="form-row">
    <button type="submit" class="btn btn-primary d-inline">Save data</button>
</div>

<a href="{{ url('employees/') }}" class="btn btn-success">to return</a>
        </form>
    </div>
@endsection