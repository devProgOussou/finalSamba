@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Dashboard Personals') }}</div>

                    <div class="card-body">
                        <table class="table">
                            @foreach($personals as $personal)
                                <tr>
                                    <th>Civilité</th>
                                    <th>Email</th>
                                    <th>Prénom et Nom</th>
                                    <th>Etat</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                </tr>
                                <tr>
                                    <td>{{ $personal->civility }}</td>
                                    <td>{{ $personal->email }}</td>
                                    <td>{{ $personal->name }}</td>
                                    <td>{{ $personal->is_active === 1 ? "Actif" : "Inactif" }}</td>
                                    <td>{{ $personal->address }}</td>
                                    <td>{{ $personal->phone }}</td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ $personals->links() }} --}}
@endsection
