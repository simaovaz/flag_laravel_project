<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>
    <form method="POST" action="{{ route('medicos.store') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right"> {{__('Name')}} </label>
            <div class="col-md-6">

            <input type="text" id="medico" class="form-control" name="name" required autofocus />
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-md-4 col-form-label text-md-right"> {{__('Address')}} </label>
            <div class="col-md-6">

            <input type="text" id="address" class="form-control" name="address" required autofocus />
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right"> {{__('Phone Number')}} </label>
            <div class="col-md-6">

            <input type="text" id="phone" class="form-control" name="phone" required autofocus />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">

            <button type="submit" id="submit" class="btn btn-primary"> {{__('Adicionar')}} </button>
            </div>
        </div>

    </form>
</x-app-layout>
