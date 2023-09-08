<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendedores cadastrados') }}
        </h2>
    </x-slot>

    <div class="w-full py-12">
        <div class="w-full flex items-center justify-end max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="seller/create" class="text-white mb-6 bg-zinc-500 hover:bg-zinc-800 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-zinc-600 dark:hover:bg-zinc-700">Cadastrar novo vendedor</a>
        </div>

        <div class="w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($sellers->isEmpty())
            <div>Nenhum vendedor cadastrado.</div>
            @else
            @foreach ($sellers as $seller)
            <div class="flex items-center justify-between w-full p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">

                <table class="w-full">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Vendedor</th>
                        <th class="text-center">Comissão (%)</th>
                    </tr>
                    <tr>
                        <td class="text-center">{{ $seller->id}}</td>
                        <td class="text-center">{{ $seller->name }}</td>
                        <td class="text-center">{{ $seller->commission }}</td>
                    </tr>
                </table>


                <a href="{{ route('seller.edit', $seller->id )}}">
                    <svg class="w-[26px] h-[26px] text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="gray" viewBox="0 0 20 20">
                        <path d="m13.835 7.578-.005.007-7.137 7.137 2.139 2.138 7.143-7.142-2.14-2.14Zm-10.696 3.59 2.139 2.14 7.138-7.137.007-.005-2.141-2.141-7.143 7.143Zm1.433 4.261L2 12.852.051 18.684a1 1 0 0 0 1.265 1.264L7.147 18l-2.575-2.571Zm14.249-14.25a4.03 4.03 0 0 0-5.693 0L11.7 2.611 17.389 8.3l1.432-1.432a4.029 4.029 0 0 0 0-5.689Z" />
                    </svg>
                </a>

            </div>

            @endforeach
            <div>{{ $sellers->links() }}</div>
            @endif

        </div>

    </div>

</x-app-layout>