<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perfil') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Médico') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-5" style="text-align: center">
                                a foto médico
                            </div>
                            <div class="col-sm-6 col-md-7">
                                <h4><strong>{{ $medico->name ?? '' }}</strong></h4>
                                <hr>
                                <p>
                                    {{ $medico->phone ?? '' }}<br>
                                    <small><cite title="">{{ $medico->address ?? '' }}</cite></small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
