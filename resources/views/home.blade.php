<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Olá, {{ $seller->name  }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h3>Cadastrar nova venda</h3>
            <div class="w-full px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">

                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="p-6 text-gray-900">
                        <label for="">Valor da venda</label>
                        @error('sale_price')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input type="number" step="0.01" min="0" placeholder="R$ 1000.00" name="sale_price">
                    </div>
                    <div class="p-6 text-gray-900">
                        <label for="">Data</label>
                        <input type="date" min="0" name="sale_date">
                    </div>
                    <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                    <button>Cadastrar venda</button>
                </form>
                <div class="w-full text-center">Comissão total atual: {{ $totalCommission }}</div>
            </div>
            <h3>Registro de vendas</h3>
            <div class="w-full px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-center">ID da Venda</th>
                            <th class="text-center">Data da Venda</th>
                            <th class="text-center">Preço da Venda</th>
                            <th class="text-center">Comissão (%)</th>
                            <th class="text-center">Valor da Comissão</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salesWithCommissionArray as $sale)
                        <tr>
                            <td class="text-center">{{ $sale['id'] }}</td>
                            <td class="text-center">{{ $sale['sale_date'] }}</td>
                            <td class="text-center">R$ {{ $sale['sale_price'] }}</td>
                            <td class="text-center">{{ $sale['commission'] }}</td>
                            <td class="text-center">R$ {{ $sale['value_commission'] }}</td>
                            <td>
                                <form action="{{ route('sales.destroy', $sale['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Excluir</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5 text-center">{{ $seller->name }} ainda não possui vendas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>