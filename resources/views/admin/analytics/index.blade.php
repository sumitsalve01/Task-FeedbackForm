@extends('layouts.master-layout')

@section('title', 'Analytics: ' . $form->title)

@section('content')
    <div class="admin-header">
        <div class="admin-title">
            📊 Analytics — {{ $form->title }}
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
    <div class="container mt-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="fw-bold mb-1">{{ $form->title }}</h4>
                <p class="text-muted">{{ $form->description }}</p>

                <div class="alert alert-info mb-0">
                    <strong><i class="fas fa-users"></i> Total Submissions:</strong>
                    {{ $totalSubmissions }}
                </div>
            </div>
        </div>
        @if ($totalSubmissions == 0)
            <div class="alert alert-warning shadow-sm">
                <i class="fas fa-exclamation-circle"></i>
                No submissions yet for this form.
            </div>
        @else
            <div class="accordion" id="answersAccordion">
                @foreach ($answers as $userId => $userAnswers)
                    @php
                        $user = $userAnswers->first()->user;
                        $collapseId = 'collapseUser' . $userId;
                        $headingId = 'headingUser' . $userId;
                    @endphp

                    <div class="accordion-item shadow-sm mb-3" style="border-radius: 10px; overflow:hidden;">

                        <h2 class="accordion-header" id="{{ $headingId }}">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ $collapseId }}" style="background: #f0f2f5;">
                                👤 {{ $user->name }}
                                <span class="text-muted ms-2">({{ $user->email }})</span>
                            </button>
                        </h2>
                        <div id="{{ $collapseId }}" class="accordion-collapse collapse"
                            data-bs-parent="#answersAccordion">
                            <div class="accordion-body">
                                @foreach ($userAnswers as $ans)
                                    <div class="mb-3 p-3 rounded" style="background:#fafbff; border:1px solid #e3e6ee;">
                                        <strong class="d-block mb-1">
                                            {{ $ans->question->question_text }}
                                        </strong>
                                        <div class="ps-4 text-dark">Answer:
                                            {!! nl2br(e($ans->answer_text)) !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
