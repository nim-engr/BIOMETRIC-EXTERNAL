@extends('layouts.app')

@section('content')

<h3>Edit Employee</h3>

<form action="{{ route('employee.update', $employee->id) }}" method="POST" class="card p-4 shadow">
    @csrf
    @method('PUT')

    @include('employee._form')

    <button class="btn btn-primary mt-3">Update Employee</button>
    <a href="{{ route('employee.index') }}" class="btn btn-secondary mt-3">Cancel</a>
</form>

@endsection
