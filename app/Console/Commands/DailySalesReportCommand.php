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
        // Get all Sellers but Admin
        $sellers = Seller::where('is_admin', '=', false)->with('sales')->get();

        // Get today date
        $reportDate = Carbon::now()->format('Y-m-d');




        $count = count($sellers);

        for ($i = 0; $i < $count; $i++) {
            $seller = $sellers[$i];



            // Obtenha as vendas do vendedor para hoje
            $sales = Sale::where('seller_id', '=', $seller->id)
                ->whereDate('sale_date', $reportDate)
                ->get();


            // Inicialize as variáveis para o cálculo da comissão e o preço total da venda
            $totalComission = 0;
            $totalSalePrice = 0;

            for ($j = 0; $j < count($sales); $j++) {
                $sale = $sales[$j];

                // Calcule a comissão para cada venda
                $comission = $sale->sale_price * ($sale->comission / 100);
                $totalComission += $comission;

                $salePrice = $sale->sale_price;
                $totalSalePrice += $salePrice;
            }

            // Formate os valores da comissão e do preço total da venda
            $totalComission = number_format($totalComission, 2, ',', '');
            $totalSalePrice = number_format($totalSalePrice, 2, ',', '');

            $reportDate = Carbon::now()->format('d-m-Y');

            // Verifique se há vendas para este vendedor
            if ($sales->isNotEmpty()) {
                // Envie um e-mail para o vendedor
                Mail::to($seller->email)->send(new DailySalesReport($seller, $sales, $reportDate, $totalComission, $totalSalePrice));
            }
        }
    }
}
