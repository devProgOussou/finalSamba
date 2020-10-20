@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Veuillez completez vos informations ') }}
                        <strong>{{ Auth::user()->name }} Type
                            : {{ Auth::user()->is_company === 1 ? 'Entreprise' : 'Personnel' }}</strong>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>image produit</th>
                                <th>Nom du produit</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            @foreach ($advertisements as $advertisement)
                                <tr>
                                    <th>{{ $advertisement->id }}</th>
                                    <td><img class="m-2" src="uploads/{{ $advertisement->image }}" alt="produit"
                                            style="height: 70px; width: 70px;"></td>
                                    <td style="">{{ $advertisement->name }}</td>
                                    <td>{{ $advertisement->description }}</td>
                                    <td>
                                        @if ($advertisement->is_available === 1)
                                            <form action="{{ route('makeArchive', $advertisement->id) }}" method="post">
                                                @csrf
                                                {{ method_field('POST') }}
                                                <button class="btn btn-outline-danger">
                                                    Archiver
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('makeDearchive', $advertisement->id) }}" method="POST">
                                                @csrf
                                                {{ method_field('POST') }}
                                                <button class="btn btn-outline-success">
                                                    Desarchiver
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
