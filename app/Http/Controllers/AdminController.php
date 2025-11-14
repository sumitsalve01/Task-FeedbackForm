<?php

namespace App\Http\Controllers;

use App\Models\FeedbackForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminLogin(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);
            $credentials = $request->only(['email', 'password']);
            if (!Auth::guard('web')->attempt($credentials)) {
                return back()->withErrors(['error' => 'Invalid login credentials.']);
            }
            return redirect()->route('admin.dashboard');
        } catch (Exception $e) {
            Log::error('Admin login error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred during login.']);
        }
    }

    public function adminLogout()
    {
        try {
            Auth::guard('web')->logout();
            return redirect()->route('admin.login.form');
        } catch (Exception $e) {
            Log::error('Admin logout error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred during logout.']);
        }
    }

    public function dashboard()
    {   
        $forms = FeedbackForm::where('status', 1)->orderBy('created_at','desc')->get();
        return view('admin.dashboard.index', compact('forms'));
    }
}
