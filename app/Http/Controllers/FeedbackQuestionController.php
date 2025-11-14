<?php

namespace App\Http\Controllers;

use App\Models\FeedbackForm;
use App\Models\FeedbackQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackQuestionController extends Controller
{
    public function index($encodedFormId)
    {
        $formId = base64_decode($encodedFormId);

        $form = FeedbackForm::findOrFail($formId);

        $questions = FeedbackQuestion::where('form_id', $formId)
            ->orderBy('order_no', 'ASC')
            ->get();

        return view('admin.feedback-questions.index', compact('form', 'questions'));
    }

    public function store(Request $request, $encodedFormId)
    {
        $formId = base64_decode($encodedFormId);

        $request->validate([
            'question_text' => 'required|max:255',
            'type'          => 'required|in:textarea,text,radio,number',
            'order_no'      => 'required|integer',
        ]);

        FeedbackQuestion::create([
            'form_id'       => $formId,
            'question_text' => $request->question_text,
            'type'          => $request->type,
            'order_no'      => $request->order_no,
            'created_by'    => Auth::id(),
            'updated_by'    => Auth::id(),
        ]);

        return redirect()->route('feedback.questions.index', $encodedFormId)
            ->with('success', 'Question added successfully!');
    }

    public function update(Request $request, $encodedId)
    {
        $id = base64_decode($encodedId);

        $request->validate([
            'question_text' => 'required|max:255',
            'type'          => 'required|in:textarea,text,radio,number',
            'order_no'      => 'required|integer',
        ]);

        $question = FeedbackQuestion::findOrFail($id);

        $question->update([
            'question_text' => $request->question_text,
            'type'          => $request->type,
            'order_no'      => $request->order_no,
            'updated_by'    => Auth::id(),
        ]);

        return redirect()->route('feedback.questions.index', base64_encode($question->form_id))
            ->with('success', 'Question updated successfully!');
    }

    public function delete($encodedId)
    {
        $id = base64_decode($encodedId);

        $question = FeedbackQuestion::findOrFail($id);
        $formId = $question->form_id;

        $question->delete();

        return redirect()->route('feedback.questions.index', base64_encode($formId))
            ->with('success', 'Question deleted successfully!');
    }
}
