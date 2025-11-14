@extends('layouts.master-layout')

@section('title', 'Admin Dashboard')

@section('content')

    {{-- Admin Header --}}
    <div class="admin-header">
        <div class="admin-title">📊 Admin Dashboard</div>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>


    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0">Feedback Forms Analytics</h3>

            <a href="{{ route('feedback.forms.index') }}" class="btn btn-primary">
                <i class="fas fa-folder-plus me-1"></i> Manage Feedback Forms
            </a>
        </div>


        {{-- Forms List --}}
        <div class="row g-4">

            @foreach ($forms as $form)

                <div class="col-md-4">
                    <div class="card card-custom shadow-sm p-3">

                        <h5 class="fw-bold">{{ $form->title }}</h5>

                        <p class="text-muted mb-3">
                            {{ Str::limit($form->description, 100) }}
                        </p>

                        <a href="{{ route('admin.feedback.analytics', base64_encode($form->id)) }}"
                            class="btn btn-info analytics-btn w-100">
                            <i class="fas fa-chart-bar me-1"></i> View Analytics
                        </a>

                    </div>
                </div>

            @endforeach

        </div>

    </div>

@endsection
