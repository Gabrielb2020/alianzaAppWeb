@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
    {{ Session::get('message')}}
    
@endif
<a href="{{ url('employees/create') }}" class="btn btn-success">register new employee</a>
<br/>
<br/>
<table class="table table-ligth">
    
    <thead class="thead-light">
        <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Telephone</th>
            <th>Identity Card</th>
            <th>Address</th>
            <th>Birth Data</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->id }}</td>
            <td>{{ $employee->first_name }}</td>
            <td>{{ $employee->last_name }}</td>          
            <td>{{ $employee->telephone }}</td>
            <td>
                <ul>
                    @foreach($employee->identity_card as $identity_card)
                     {{ $identity_card }}
                    @endforeach
                </ul>                
            </td>
            <td>
                <ul>
                    @foreach($employee->address as $address)
                    {{ $address }}
                    @endforeach
                </ul>                
            </td>
            <td>
                <ul>
                    @foreach($employee->birth_data as $birth_data)
                    {{ $birth_data }}
                    @endforeach
                </ul>                
            </td>
            <td> 
                <a href="{{ url('employees/'.$employee->id.'/edit') }} " class="btn btn-warning">
                    Edit
                </a> 
                <form action="{{ url('employees/'.$employee->id )}}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" value="Delete">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    
</table>

</div>

@endsection