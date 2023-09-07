<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil do vendedor') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex items-center justify-between px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <form action="{{ route('seller.update',  $seller->id) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="p-6 text-gray-900">
                        <label for="">Nome</label>
                        <input type="text" placeholder="Digite o nome" value="{{ $seller->name }}" name="name">
                    </div>
                    <div class="p-6 text-gray-900">
                        <label for="">E-mail</label>
                        <input type="text" placeholder="Digite o e-mail" value="{{ $seller->email }}" name="email">
                    </div>
                    <!-- <div class="p-6 text-gray-900">
                            <label for="">Comissão</label>
                            <input type="number" step="any" min="0" value="8.5" name="comission"> %
                        </div> -->
                    <button>Salvar</button>
                </form>
                <div class="w-full text-center">Comissão atual: 8.5%</div>
                <form action="{{ route( 'seller.destroy', $seller )}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Excluir</button>
                </form>
            </div>

            <div class="w-full px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <h3>Cadastrar nova venda</h3>
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="p-6 text-gray-900">
                        <label for="">Valor da venda</label>
                        @error('sale_price')
                        <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <input type="text" placeholder="R$ 1000.00" name="sale_price">
                    </div>
                    <div class="p-6 text-gray-900">
                        <label for="">Data</label>
                        <input type="date" min="0" name="sale_date">
                    </div>
                    <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                    <button>Cadastrar venda</button>
                </form>
            </div>
            <h3>Registro de vendas</h3>
            <div class="w-full px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                @forelse ($seller->sales as $sale)
                <div>{{ $sale }}</div>
                @empty
                <div> {{ $seller->name }} ainda não possui vendas.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>