<?php

namespace App\Http\Controllers;

use App\Events\LoanRequestStatusUpdated;
use App\Http\Requests\updateLoanRequest;
use App\Models\LoanRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminLoanRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\LoanRequest::query();

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('full_name', 'like', "%{$searchTerm}%")
                    ->orWhere('email', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('status') && $request->status) {
            $status = $request->status;
            $query->where('application_status', $status);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        $loanRequests = $query->paginate(10);
        return view('admin.loan_request.index', compact('loanRequests'));
    }

    public function show($id)
    {
        $requestForm = LoanRequest::find($id);
        if (!$requestForm) {
            return response()->json(['error' => 'Loan request not found.'], 404);
        }
        return response()->json($requestForm);
    }

    public function update(updateLoanRequest $request, $id): JsonResponse
    {
        $loanRequest = LoanRequest::find($id);
        if (!$loanRequest) {
            return response()->json(['message' => 'Loan request not found'], 404);
        }
        $loanRequest->application_status = $request->application_status;
        $loanRequest->save();
       event(new LoanRequestStatusUpdated($loanRequest,$request->reason));
        return response()->json(['message' => 'Loan request updated successfully']);
    }

    public function destroy($id): JsonResponse
    {
        $loanRequest = LoanRequest::find($id);

        if (!$loanRequest) {
            return response()->json(['message' => 'Loan request not found'], 404);
        }
        $loanRequest->delete();
        return response()->json(['message' => 'Loan request deleted successfully']);
    }

}
