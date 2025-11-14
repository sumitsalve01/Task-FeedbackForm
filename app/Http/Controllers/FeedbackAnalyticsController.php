<?php

namespace App\Http\Controllers;

use App\Models\FeedbackForm;
use App\Models\FeedbackAnswer;
use App\Models\FeedbackQuestion;
use App\Models\User;

class FeedbackAnalyticsController extends Controller
{
    public function index($encodedFormId)
    {
        $formId = base64_decode($encodedFormId);

        $form = FeedbackForm::findOrFail($formId);
        $questions = FeedbackQuestion::where('form_id', $formId)
            ->orderBy('order_no', 'ASC')
            ->get();
        $answers = FeedbackAnswer::where('form_id', $formId)
            ->with('question', 'user')
            ->get()
            ->groupBy('user_id');
        $totalSubmissions = $answers->count();
        return view('admin.analytics.index', compact(
            'form',
            'questions',
            'answers',
            'totalSubmissions'
        ));
    }
}
