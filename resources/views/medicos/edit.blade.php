<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Médicos') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('medicos.update', $medico->id) }}">
        @csrf @method('PUT')

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>
            <div class="col-md-6">
                <input type="text" id="name" class="form-control @error('name') is-invalid  @enderror" name="name" value="{{ $medico->name ?? ''}}" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('Morada') }}</label>
            <div class="col-md-6">
                <input type="text" id="address" class="form-control @error('address') is-invalid  @enderror" name="address" value="{{ $medico->address }}" required autofocus>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>
            <div class="col-md-6">
                <input type="text" id="phone" class="form-control @error('phone') is-invalid  @enderror" name="phone" value="{{ $medico->phone }}" required autofocus>
                @error('phone')
                    @foreach ( $errors->getMessages()['phone'] as $message )
                        <li class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </li>
                    @endforeach
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
