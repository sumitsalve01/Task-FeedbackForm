@extends('layouts.website-layout')

@section('title', 'User Register')

@section('content')
<div class="container" style="max-width: 450px;">
    <div class="card shadow-sm">
        <div class="card-body">

            <h3 class="text-center mb-3">Create Account</h3>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('user.register.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div>
                    <label class="form-label">Mobile Number</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button class="btn btn-success w-100">Register</button>

                <p class="mt-3 text-center">
                    Already have an account?
                    <a href="{{ route('user.login') }}">Login</a>
                </p>
            </form>

        </div>
    </div>
</div>
@endsection
