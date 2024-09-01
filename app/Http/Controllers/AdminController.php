<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function dashboard(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $loanRequestCounts = \App\Models\LoanRequest::selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN application_status = 'approved' THEN 1 ELSE 0 END) as approved,
                SUM(CASE WHEN application_status = 'pending' THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN application_status = 'rejected' THEN 1 ELSE 0 END) as rejected
            ")->first();

        $loanRequestCount = $loanRequestCounts->total;
        $approvedRequestCount = $loanRequestCounts->approved;
        $pendingRequestCount = $loanRequestCounts->pending;
        $rejectedRequestCount = $loanRequestCounts->rejected;
        return view('admin.dashboard',compact('loanRequestCount', 'approvedRequestCount', 'pendingRequestCount', 'rejectedRequestCount'));
    }


    public function logout(): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
