<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil do vendedor') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('dashboard') }}" class="text-white mb-6 bg-zinc-500 hover:bg-zinc-800 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-zinc-600 dark:hover:bg-zinc-700">
                <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"></path>
                </svg>
                <span class="sr-only">Voltar</span>
            </a>
            <div class="w-full p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="w-full flex items center justify-between gap-12">
                    <p class="block text-sm font-medium text-gray-900 ">Código ID: {{ $seller->id }}</p>
                    <div class="flex items center justify-end gap-12">
                        <div class="text-green-700 bg-green-100 text-center font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 border border-green-700">Comissão total atual: R$ {{ $totalCommission }}</div>
                        <form action="{{ route( 'seller.destroy', $seller )}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Excluir cadastro</button>
                        </form>
                    </div>

                </div>

                <form action="{{ route('seller.update',  $seller->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="w-full flex items-center justify-between">
                        <div class="w-full p-6 text-gray-900">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Nome</label>
                            <input type="text" placeholder="Digite o nome" value="{{ $seller->name }}" name="name" class="w-full bg-gray-50 border-gray-300 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none block w-full p-2.5">
                            @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full p-6 text-gray-900">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">E-mail</label>
                            <input type="text" placeholder="Digite o e-mail" value="{{ $seller->email }}" name="email" class="w-full bg-gray-50 border-gray-300 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none block w-full p-2.5">
                            @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full p-6 text-gray-900">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Comissão (%)</label>
                            @error('comission')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                            <input type="number" step="0.01" min="0" value="{{ $seller->commission }}" placeholder="8.5" name="commission" class="w-full bg-gray-50 border-gray-300 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none block w-full p-2.5">
                        </div>
                    </div>

                    <button type="submit" class="w-full text-center text-white bg-zinc-500 hover:bg-zinc-800 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center flex items-center justify-center mr-2 dark:bg-zinc-600 dark:hover:bg-zinc-700">Salvar alterações</button>
                </form>


            </div>

            <div class="w-full p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <h3 class="block text-sm font-medium text-gray-900 ">Cadastrar nova venda</h3>
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="w-full flex items-center justify-between">
                        <div class="w-full p-6 text-gray-900">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900">Valor da venda</label>

                            <input type="number" step="0.01" min="0" placeholder="R$ 1000.00" name="sale_price" class="w-full bg-gray-50 border-gray-300 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none block w-full p-2.5">
                            @error('sale_price')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="w-full p-6 text-gray-900">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900">Data</label>
                            <input type="date" min="0" name="sale_date" class="w-full bg-gray-50 border-gray-300 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none block w-full p-2.5">
                            @error('sale_date')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                    <button type="submit" class="w-full text-center text-white bg-zinc-500 hover:bg-zinc-800 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center flex items-center justify-center mr-2 dark:bg-zinc-600 dark:hover:bg-zinc-700">Cadastrar venda</button>
                </form>
            </div>

            <div class="w-full p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <h3 class="block text-sm font-medium text-gray-900 mb-4">Registro de vendas</h3>
                <table class="w-full">
                    <thead style="height: 100px; overflow-y:scroll">
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
                        <tr class="hover:bg-zinc-100 rounded">
                            <td class="text-center">{{ $sale['id'] }}</td>
                            <td class="text-center">{{ $sale['sale_date'] }}</td>
                            <td class="text-center">R$ {{ $sale['sale_price'] }}</td>
                            <td class="text-center">{{ $sale['commission'] }}</td>
                            <td class="text-center">R$ {{ $sale['value_commission'] }}</td>
                            <td class="flex items-center justify-center">
                                <form action="{{ route('sales.destroy', $sale['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 m-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">X</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class=" text-center pt-8">{{ $seller->name }} ainda não possui vendas cadastradas.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>