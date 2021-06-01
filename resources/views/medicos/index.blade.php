<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="col-lg-6 pull-right">
        <a class="btn btn-info" href="{{ route('medicos.create') }}" title="{{__('Novo Médico') }}" >{{__('Novo Médico') }} </a>
    </div>
    @if(Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message')}}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error )
            <li> {{ $error }} </li>
        @endforeach
        </ul>
    </div>
    @endif

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td> <strong> Name </strong></td>
                    <td> <strong> Address </strong> </td>
                    <td> <strong>Phone Number </strong> </td>
                    <td> <strong> Actions </strong> </td>
                </tr>
            </thead>
            <tbody>

                    @foreach ($medicos as $medico )
                    <tr>
                        <td> {{ $medico-> name ?? ''}} </td>
                        <td> {{ $medico-> address  ?? ''}} </td>
                        <td> {{ $medico-> phone ?? ''}} </td>
                        <td> <a class="btn btn-small btn-success" href=" {{ route('medicos.show', $medico->id) }} "> <i class="fa fa-eye"> </i> </td>
                    </tr>
                    @endforeach
            </tbody>

        </table>
</x-app-layout>


