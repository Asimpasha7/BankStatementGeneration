<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use League\Csv\Reader;

use Illuminate\Support\Facades\Mail;
// use Barryvdh\Snappy\Facades\SnappyPdf as PDF;



class TransactionService
{
    public function getTransactions($startDate, $endDate, $email)
    {

        // $filePath = public_path('data/transactions.csv');
        // dd($filePath);
        $csvData = Storage::disk('public')->get('data/transactions.csv');
        
        $csv = Reader::createFromString($csvData);
        $csv->setHeaderOffset(0); 

        $transactions = $csv->getRecords();
        $filteredTransactions = [];

        foreach ($transactions as $transaction) {
            if (
                $transaction['user_email'] == $email &&
                $transaction['date_of_transaction'] >= $startDate &&
                $transaction['date_of_transaction'] <= $endDate
            ) {
                $filteredTransactions[] = $transaction;
            }
        }

       
        return $filteredTransactions;

    }

    public function generatePdf($transactions)
    {
        if (empty($transactions)) {
            // Handle the case where there are no transactions
            session()->flash('error', 'No Transaction Exists.');
            return redirect()->back();
            // return null;
        }
        $data = [
            'transactions' => $transactions,
        ];
        $pdf = PDF::loadView('transactions', $data);
        $filename = 'transactions_' . now()->timestamp . '.pdf';
        $pdf->save(public_path('data/' . $filename));
        return $pdf->output();
    }

    public function sendEmail($email, $pdf)
    {
    
       
        if (empty($pdf)) {
            session()->flash('error', 'PDF content is empty.');
            return redirect()->back();
        }

        $subject = 'Bank Statement';
        $body = 'Please find attached your bank statement.';

      
        Mail::send([], [], function ($message) use ($email, $subject, $body, $pdf) {
            $message->to($email);
            $message->subject($subject);
            $message->setBody($body, 'text/plain');
       
            $message->attachData($pdf, 'bank_statement.pdf', [
                'mime' => 'application/pdf',
            ]);
        });
        return true;

    }
}
