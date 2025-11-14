@extends('layouts.website-layout')

@section('title', $form->title)

@section('content')
    <div class="container mt-4">
        <a href="{{ route('home.feedback') }}" class="btn btn-secondary mb-3">
            ← Back
        </a>

        <h3>{{ $form->title }}</h3>
        <p class="text-muted">{{ $form->description }}</p>

        @guest
            <div class="alert alert-warning">
                You must <a href="{{ route('user.login') }}">login</a> or
                <a href="{{ route('user.register') }}">register</a> to fill the form.
            </div>
        @endguest

        @auth
            @if ($alreadySubmitted)
                <div class="alert alert-success">
                    Thank you! You have already submitted this feedback.
                </div>
            @else
                <form action="{{ route('user.feedback.submit', base64_encode($form->id)) }}" method="POST">
                    @csrf

                    @foreach ($questions as $q)
                        <div class="mb-3">
                            <label class="form-label">{{ $q->question_text }}</label>

                            @if ($q->type == 'textarea')
                                <textarea class="form-control" name="question_{{ $q->id }}" required></textarea>
                            @elseif($q->type == 'text')
                                <input type="text" class="form-control" name="question_{{ $q->id }}" required>
                            @elseif($q->type == 'number')
                                <input type="number" class="form-control" name="question_{{ $q->id }}" required>
                            @elseif($q->type == 'radio')
                                <label><input type="radio" name="question_{{ $q->id }}" value="Yes" required>
                                    Yes</label>
                                <label class="ms-3"><input type="radio" name="question_{{ $q->id }}" value="No">
                                    No</label>
                            @endif
                        </div>
                    @endforeach

                    <button class="btn btn-success">Submit Feedback</button>
                </form>
            @endif
        @endauth

    </div>
@endsection
