<h1>{{$mode}} employee</h1>
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
    <input class="form-control" type="string" value="{{ isset($employee->identity_card) ? $employee->identity_card : '' }}" name="identity_card" required>
    
</div>
<div class="form-row">
    <label>Address</label>
    <input class="form-control" type="string" value="{{ isset($employee->address) ? $employee->address : '' }}" name="address" required>

</div>
<div class="form-row">
    <label>Birth Data</label>
    <input class="form-control" type="number" value="{{ isset($employee->birth_data) ? $employee->birth_data : '' }}" name="birth_data" required>

</div>
<div class="form-row">
    <button type="submit" class="btn btn-primary d-inline">Save data</button>
</div>

<a href="{{ url('employees/') }}" class="btn btn-success">to return</a>