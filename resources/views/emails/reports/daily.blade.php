<!DOCTYPE html>
<html>

<head>
    <title>Relatório de Vendas</title>
</head>

<body>

    <div style="font-family: Arial, sans-serif;">
        <h1 style="color: #333">Olá {{ $seller->name }}</h1>

        <h3 style="color: #444">Relatório de vendas do dia {{$reportDate}}</h3>

        <table border="1" style="width: 40%; border-collapse: collapse; margin: 20px;">
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 10px; text-align: center;">ID Venda</th>
                <th style="padding: 10px; text-align: center;">Valor</th>
                <th style="padding: 10px; text-align: center;">Comissão</th>
            </tr>
            @foreach ($sales as $sale)
            <tr>
                <td style="padding: 10px; text-align: center;">{{$sale->id}}</td>
                <td style="padding: 10px; text-align: center;">R$ {{$sale->sale_price}}</td>
                <td style="padding: 10px; text-align: center;">{{$sale->commission}} %</td>
            </tr>
            @endforeach
        </table>

        <table border="1" style="width: 40%; border-collapse: collapse; margin: 20px;">
            <tr>
                <th colspan="2" style="padding: 10px; text-align: center;">Valor total das vendas</th>
                <td style="padding: 10px; text-align: center;">R$ {{ $totalSalePrice }}</td>
            </tr>
            <tr style="background-color: #EBE7FA;">
                <th colspan="2" style="padding: 10px; text-align: center;">Total à receber</th>
                <td style="padding: 10px; text-align: center;">R$ {{ $totalCommission }}</td>
            </tr>
        </table>
    </div>

</body>

</html>