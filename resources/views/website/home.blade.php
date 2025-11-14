@extends('layouts.website-layout')

@section('title', 'Available Feedback Forms')

@section('content')

<div class="container">

    <h2 class="fw-bold mb-4" style="color:#333;">
        <i class="fas fa-file-alt"></i> Available Feedback Forms
    </h2>

    <div class="row">

        @forelse($forms as $form)
            <div class="col-md-4">
                <div class="card card-custom shadow-sm mb-4">
                    <div class="card-body">

                        <h5 class="fw-bold">{{ $form->title }}</h5>
                        <p class="text-muted">{{ Str::limit($form->description, 80) }}</p>

                        <a href="{{ route('home.feedback.form', base64_encode($form->id)) }}"
                           class="btn btn-soft w-100 mt-2">
                            <i class="fas fa-pen"></i> Fill Feedback
                        </a>

                    </div>
                </div>
            </div>

        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No forms available at the moment.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
