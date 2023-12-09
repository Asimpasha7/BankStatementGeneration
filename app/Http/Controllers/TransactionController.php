<?php


// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function generatePdf(Request $request, TransactionService $transactionService)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'user_email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Retrieve validated data
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $email = $request->input('user_email');

        // Call transaction service to get relevant transactions
        $transactions = $transactionService->getTransactions($startDate, $endDate, $email);


        dd($transactions);
        // Call PDF generation service
        $pdf = $transactionService->generatePdf($transactions);

        // Call email service
        $transactionService->sendEmail($email, $pdf);

        return response()->json(['message' => 'PDF generated and sent successfully']);
    }
}
