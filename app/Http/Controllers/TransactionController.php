<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    //
    private static ?self $instance = null;

    public static function returnInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }



    public function sendThirdPartyTransaction()
    {
        $transactions = config('fake_transactions_data.transactions');

        if (empty($transactions)) {
            $this->error('No transactions found in the config file.');
            return;
        }
        $transaction = $transactions[array_rand($transactions)];

        $response = $this->sendTransaction($transaction, 'third');

        if ($response['status'] === 'success') {
            $this->info('Transaction sent successfully');
        } else {
            $this->error('Failed to send transaction');
        }

        return response()->json(['message' => 'Transactions sent successfully']);
    }




    private function sendTransaction(array $transaction, string $type): array
    {
        if ($type === 'third') {
            $url = config('fake_transactions_data.third_party_url');

            try {
                $response = Http::post($url, $transaction);

                if ($response['status'] === 'success') {
                    return [
                        'status' => 'success',
                        'message' => 'Transaction sent successfully',
                        'response' => $response->json(),
                    ];
                } else {
                    Log::error('Third-party API request failed', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);

                    return [
                        'status' => 'error',
                        'message' => 'Third-party API request failed',
                        'response' => $response->body(),
                    ];
                }
            } catch (\Exception $e) {
                Log::error('Third-party API request error', ['error' => $e->getMessage()]);

                return [
                    'status' => 'failed',
                    'message' => 'Error sending transaction',
                    'error' => $e->getMessage(),
                ];
            }
        }

        return ['status' => 'failed', 'message' => 'Invalid transaction type'];
    }
}
