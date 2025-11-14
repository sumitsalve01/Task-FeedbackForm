<?php

namespace App\Http\Controllers;

use App\Models\FeedbackAnswer;
use App\Models\FeedbackForm;
use App\Models\FeedbackQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserFeedbackController extends Controller
{

    public function login()
    {
        return view('website.user-authentication.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            if ($user->role && $user->role->alias === 'User') {
                return redirect()->route('home.feedback');
            }
            Auth::logout();
            return back()->withErrors([
                'error' => 'Only normal users can login here. Admin/Superadmin cannot login.'
            ]);
        }
        return back()->withErrors(['error' => 'Invalid email or password']);
    }

    public function register()
    {
        return view('website.user-authentication.register');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
            'mobile'                => 'nullable|string|max:10',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'mobile'   => $request->mobile,
            'role_id'  => 2,
        ]);

        return redirect()->route('user.login')->with('success', 'Account created! Please login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.feedback');
    }


    public function showHomeForm()
    {
        $forms = FeedbackForm::where('status', 1)->orderBy('created_at', 'desc')->get();

        return view('website.home', compact('forms'));
    }


    public function showForm($encodedId)
    {
        $formId = base64_decode($encodedId);

        $form = FeedbackForm::findOrFail($formId);
        $alreadySubmitted = false;

        if (Auth::check()) {
            $alreadySubmitted = FeedbackAnswer::where('form_id', $formId)
                ->where('user_id', Auth::id())
                ->exists();
        }

        $questions = FeedbackQuestion::where('form_id', $formId)
            ->orderBy('order_no', 'ASC')
            ->get();

        return view('website.form-view', compact('form', 'questions', 'alreadySubmitted'));
    }


    public function submit(Request $request, $encodedId)
    {
        $formId = base64_decode($encodedId);
        $exists = FeedbackAnswer::where('form_id', $formId)
            ->where('user_id', Auth::id())
            ->exists();

        if ($exists) {
            return redirect()->route('home.feedback')
                ->with('success', 'You have already submitted this feedback!');
        }
        $questions = FeedbackQuestion::where('form_id', $formId)->get();

        foreach ($questions as $q) {
            $answer = $request->input('question_' . $q->id);
            if (is_array($answer)) {
                $answer = json_encode($answer);
            }
            FeedbackAnswer::create([
                'form_id'     => $formId,
                'question_id' => $q->id,
                'user_id'     => Auth::id(),
                'answer_text' => $answer,
                'created_by'  => Auth::id(),
                'updated_by'  => Auth::id(),
            ]);
        }

        return redirect()->route('home.feedback.form', ['id' => base64_encode($formId)])->with('success', 'Thank you for your feedback!');
    }
}
