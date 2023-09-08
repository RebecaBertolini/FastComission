<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailySalesReport;
use App\Models\Seller;
use App\Models\Sale;
use Carbon\Carbon;

class SendDaylyEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Obtenha todos os Sellers que não são administradores com suas vendas
        $sellers = Seller::where('is_admin', false)->with('sales')->get();

        // Obtenha a data de hoje
        $reportDate = Carbon::now()->format('Y-m-d');

        foreach ($sellers as $seller) {
            // Obtenha as vendas do vendedor para hoje
            $sales = Sale::where('seller_id', $seller->id)
                ->whereDate('sale_date', $reportDate)
                ->get();

            $totalCommission = 0;
            $totalSalePrice = 0;

            foreach ($sales as $sale) {
                // Calcule a comissão para cada venda
                $commission = $sale->sale_price * ($sale->commission / 100);
                $totalCommission += $commission;

                $salePrice = $sale->sale_price;
                $totalSalePrice += $salePrice;
            }

            // Formate os valores da comissão e do preço total da venda
            $totalCommission = number_format($totalCommission, 2, ',', '');
            $totalSalePrice = number_format($totalSalePrice, 2, ',', '');

            // Formate a data para exibição
            $formattedReportDate = Carbon::now()->format('d-m-Y');

            // Verifique se existem vendas
            if ($sales->isNotEmpty()) {
                // Envie o e-mail para o vendedor
                Mail::to($seller->email)->send(new DailySalesReport($seller, $sales, $formattedReportDate, $totalCommission, $totalSalePrice));
            }
        }
    }
}
