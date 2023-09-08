<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar novo vendedor') }}
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
            <div class="w-full flex items-center justify-between px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <form action="{{ route('store') }}" method="POST" class="w-full">
                    @csrf
                    <div class="w-full flex justify-between">
                        <div class="w-full p-6 text-gray-900">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">Nome</label>

                            <input type="text" value="{{ old('name') }}" placeholder="Digite o nome" name="name" class="w-full bg-gray-50 border-gray-300 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none block w-full p-2.5">
                            @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full p-6 text-gray-900">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900">E-mail</label>

                            <input type="text" value="{{ old('email') }}" placeholder="Digite o e-mail" name="email" class="w-full bg-gray-50 border-gray-300 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none block w-full p-2.5">
                            @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full p-6 text-gray-900">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900">Comissão (%)</label>

                            <input type="number" step="0.01" min="0" value="8.5" placeholder="8.5" name="commission" class="w-full bg-gray-50 border-gray-300 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none block w-full p-2.5">
                            @error('comission')
                            <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="w-full text-center text-white mb-6 bg-zinc-500 hover:bg-zinc-800 focus:outline-none font-medium rounded-full text-sm p-2.5 text-center flex items-center justify-center mr-2 dark:bg-zinc-600 dark:hover:bg-zinc-700">Cadastrar</button>
                </form>
            </div>


        </div>
    </div>
</x-app-layout>