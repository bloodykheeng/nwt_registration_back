<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will help us to send invoices by mail';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Log::info("sendinvoice cron working");
    }
}
