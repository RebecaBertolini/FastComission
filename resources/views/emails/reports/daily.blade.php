<h1>Olá {{ $seller->name}}</h1>

<h3>Relatório de vendas do dia {{$reportDate}}</h3>

@foreach ($sales as $sale)
<p>{{$sale->sale_price}}</p>
@endforeach