<?php

namespace App\Console\Commands;

use App\Http\Controllers\TransactionController;
use Illuminate\Console\Command;

class SendFakeTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-fake-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $transactionController = TransactionController::returnInstance();
        $transactionController->sendThirdPartyTransaction();
    }
}
