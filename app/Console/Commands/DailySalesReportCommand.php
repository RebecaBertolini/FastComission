<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailySalesReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily-sales-report:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily sales report email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
    }
}
