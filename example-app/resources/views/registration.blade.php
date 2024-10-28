@extends('layout')
@section('title', 'Registration')
@section('content')
<div class="container paddin-6" style="background: darkblue, padding">

    <form action="{{route('registrationPost')}}" method="POST" style="width: 400px" class="ms-auto me-auto mt-5">
        @csrf
        <div class="mb-3 bg-primary-subtle border border-primary-subtle rounded-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3 bg-primary-subtle border border-primary-subtle rounded-3">
            <label for="email" class="form-label bs-blue-100">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3 bg-primary-subtle border border-primary-subtle rounded-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


</div>

@endsection