<?php

namespace App\Http\Controllers;

use App\Models\FeedbackForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackFormController extends Controller
{
    public function index()
    {
        $forms = FeedbackForm::orderBy('id', 'DESC')->get();
        return view('admin.feedback-forms.index', compact('forms'));
    }

    public function create()
    {
        return view('admin.feedback-forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'status'      => 'required|in:0,1',
        ]);

        FeedbackForm::create([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'created_by'  => Auth::id(),
            'updated_by'  => Auth::id(),
        ]);

        return redirect()->route('feedback.forms.index')->with('success', 'Form created successfully');
    }

    public function edit($id)
    {
        $formID = base64_decode($id);
        $form = FeedbackForm::findOrFail($formID);
        return view('admin.feedback-forms.edit', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'status'      => 'required|in:0,1',
        ]);

        $formID = base64_decode($id);
        $form = FeedbackForm::findOrFail($formID);

        $form->update([
            'title'       => $request->title,
            'description' => $request->description,
            'status'      => $request->status,
            'updated_by'  => Auth::id(),
        ]);

        return redirect()->route('feedback.forms.index')->with('success', 'Form updated successfully');
    }

    public function destroy($id)
    {
        $formID = base64_decode($id);
        $form = FeedbackForm::findOrFail($formID);
        $form->delete();

        return redirect()->route('feedback.forms.index')->with('success', 'Form deleted successfully');
    }
}
