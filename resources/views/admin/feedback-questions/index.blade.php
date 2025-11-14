@extends('layouts.master-layout')

@section('title', 'Questions')

@section('content')
    <div class="admin-header">
        <div class="admin-title">
            ❓ Manage Questions — {{ $form->title }}
        </div>

        <a href="{{ route('feedback.forms.index') }}" class="btn btn-light btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                <i class="fas fa-plus-circle"></i> Add Question
            </button>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Question</th>
                        <th>Type</th>
                        <th>Order</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $q)
                        <tr>
                            <td>{{ $q->question_text }}</td>
                            <td><span class="badge bg-info">{{ $q->type }}</span></td>
                            <td>{{ $q->order_no }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary mx-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $q->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="{{ route('feedback.questions.delete', base64_encode($q->id)) }}"
                                   class="btn btn-sm btn-outline-danger mx-1"
                                   onclick="return confirm('Are you sure you want to delete this question?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>


                        {{-- Edit Modal --}}
                        <div class="modal fade" id="editModal{{ $q->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow">

                                    <form action="{{ route('feedback.questions.update', base64_encode($q->id)) }}"
                                          method="POST">
                                        @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-edit"></i> Edit Question
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>


                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Question Text</label>
                                                <input type="text" name="question_text"
                                                       value="{{ $q->question_text }}"
                                                       class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Question Type</label>
                                                <select name="type" class="form-select">
                                                    <option value="textarea" {{ $q->type == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                                    <option value="text" {{ $q->type == 'text' ? 'selected' : '' }}>Text Field</option>
                                                    <option value="radio" {{ $q->type == 'radio' ? 'selected' : '' }}>Radio Button</option>
                                                    <option value="number" {{ $q->type == 'number' ? 'selected' : '' }}>Number</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Order No</label>
                                                <input type="number" name="order_no"
                                                       value="{{ $q->order_no }}"
                                                       class="form-control" required>
                                            </div>

                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>


        {{-- Add Modal--}}
        <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow">

                    <form action="{{ route('feedback.questions.store', base64_encode($form->id)) }}"
                          method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-plus-circle"></i> Add Question
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>


                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label fw-bold">Question Text</label>
                                <input type="text" name="question_text" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Question Type</label>
                                <select name="type" class="form-select">
                                    <option value="textarea">Textarea</option>
                                    <option value="text">Text Field</option>
                                    <option value="radio">Radio Button</option>
                                    <option value="number">Number</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Order No</label>
                                <input type="number" name="order_no" class="form-control" required>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
