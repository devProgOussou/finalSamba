@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Dashboard Companies') }}</div>

                    <div class="card-body">
                        <table class="table">
                            @foreach($companies as $company)
                                <tr>
                                    <th>Civilité</th>
                                    <th>Prénom et Nom</th>
                                    <th>Entreprise</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                </tr>
                                <tr>
                                    <td>{{ $company->civility }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->company }}</td>
                                    <td>{{ $company->addressCompany }}</td>
                                    <td>{{ $company->phone }}</td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $companies->links() }}
@endsection