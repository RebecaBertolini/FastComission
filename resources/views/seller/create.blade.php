<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar novo vendedor') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex items-center justify-between px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <div class="p-6 text-gray-900">
                        <label for="">Nome</label>
                        <input type="text" placeholder="Digite o nome" name="name">
                    </div>
                    <div class="p-6 text-gray-900">
                        <label for="">E-mail</label>
                        <input type="text" placeholder="Digite o e-mail" name="email">
                    </div>
                    <div class="p-6 text-gray-900">
                        <label for="">Comissão</label>
                        <input type="number" step="0.01" min="0" value="8.5" placeholder="8.5" name="comission"> %
                    </div>
                    <button>Cadastrar</button>
                </form>
                <div class="w-full text-center">Comissão atual: 8.5%</div>
            </div>


        </div>
    </div>
</x-app-layout>