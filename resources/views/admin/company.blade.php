@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($company_id as $company)
                    <div class="card">
                        <div
                            class="card-header text-center">{{ __('Dashboard Company ') }} {{ $company->company }}</div>

                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Civilité</th>
                                    <th>Prénom et Nom</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                </tr>
                                <tr>
                                    <td>{{ $company->civility }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->addressCompany }}</td>
                                    <td>{{ $company->phone }}</td>

                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
                <br>
                @foreach($advertisements as $advertisement)

                @endforeach
            </div>
        </div>
    </div>
    {{-- {{ $personals->links() }} --}}
@endsection
