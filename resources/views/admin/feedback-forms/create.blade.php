@extends('layouts.master-layout')

@section('title', 'Create Feedback Form')

@section('content')

    <div class="admin-header">
        <div class="admin-title">➕ Create Feedback Form</div>

        <a href="{{ route('feedback.forms.index') }}" class="btn btn-light btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="container mt-4">

        <div class="card shadow-sm p-4">

            <form action="{{ route('feedback.forms.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Form Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button class="btn btn-success px-4">
                    <i class="fas fa-check"></i> Create
                </button>

            </form>

        </div>

    </div>

@endsection
