@extends('layouts.master-layout')

@section('title', 'Feedback Forms')

@section('content')

    {{-- Header --}}
    <div class="admin-header">
        <div class="admin-title">📝 Manage Feedback Forms</div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>


    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('feedback.forms.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif


        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($forms as $form)
                        <tr>
                            <td>{{ $form->title }}</td>
                            <td>
                                <span class="badge {{ $form->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $form->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>

                                {{-- Edit --}}
                                <a href="{{ route('feedback.forms.edit', base64_encode($form->id)) }}"
                                    class="btn btn-sm btn-outline-primary mx-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- Delete --}}
                                <a href="{{ route('feedback.forms.delete', base64_encode($form->id)) }}"
                                    onclick="return confirm('Are you sure you want to delete this form?');"
                                    class="btn btn-sm btn-outline-danger mx-1" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>

                                {{-- Questions --}}
                                <a href="{{ route('feedback.questions.index', base64_encode($form->id)) }}"
                                    class="btn btn-sm btn-outline-info mx-1" title="Add Questions">
                                    <i class="fas fa-file"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>

@endsection
