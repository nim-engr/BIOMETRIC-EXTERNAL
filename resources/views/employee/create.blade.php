@extends('layouts.app')

@section('content')

<h3>Add Employee</h3>

@if($errors->any())
    <div class="alert alert-danger">Please fix the errors below.</div>
@endif

<form action="{{ route('employee.store') }}" method="POST" class="card p-4 shadow">
    @csrf
    @include('employee._form')

    <button class="btn btn-success mt-3">Save Employee</button>
    <a href="{{ route('employee.index') }}" class="btn btn-secondary mt-3">Cancel</a>
</form>

@endsection
