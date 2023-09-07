<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailySalesReport;
use App\Models\Seller;
use App\Models\Sale;
use Carbon\Carbon;

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
        // Get all Sellers
        $sellers = Seller::all();

        // Get today date
        $reportDate = Carbon::now()->format('Y-m-d');

        foreach ($sellers as $seller) {
            // get today saller sales
            $sales = Sale::where('seller_id', $seller->id)
                ->whereDate('sale_date', $reportDate)
                ->get();

            // Check for sales for this seller
            if ($sales->isNotEmpty()) {
                // Send e-mail to seller
                Mail::to($seller->email)->send(new DailySalesReport($seller, $sales, $reportDate));
            }
        }
    }
}
