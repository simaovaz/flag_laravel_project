<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Especialidades') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('especialidades.update', $especialidade->id) }}">
        @csrf @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
            <div class="col-md-6">
                <input type="text" id="name" class="form-control @error('name') is-invalid  @enderror" name="name" value="{{ $especialidade->name ?? ''}}" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __("Editar") }}
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
