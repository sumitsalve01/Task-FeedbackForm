@extends('layouts.website-layout')

@section('title', 'User Login')

@section('content')
<div class="container" style="max-width: 450px;">
    <div class="card shadow-sm">
        <div class="card-body">

            <h3 class="text-center mb-3">User Login</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('user.login.post') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Login</button>

                <p class="mt-3 text-center">
                    Don't have an account?
                    <a href="{{ route('user.register') }}">Register</a>
                </p>
            </form>

        </div>
    </div>
</div>
@endsection
