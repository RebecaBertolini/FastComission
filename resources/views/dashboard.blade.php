<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendedores cadastrados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full flex items-center justify-end max-w-7xl mx-auto sm:px-6 lg:px-8 my-6">
            <a href="seller/create" class="border-solid border-2 border-grey-500 px-4 py-2">Cadastrar novo vendedor</a>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($sellers->isEmpty())
            <div>Nada</div>
            @else
            @foreach ($sellers as $seller)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    {{ $seller->name }}
                </div>
                <a href="{{ route('seller.edit', $seller->id )}}">Editar</a>

            </div>
            @endforeach
            @endif
        </div>
    </div>
</x-app-layout>