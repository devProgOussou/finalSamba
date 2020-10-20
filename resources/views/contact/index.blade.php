@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @foreach($messages as $message)
                        <table class="table">
                            <tr>
                                <th scope="row">nom</th>
                                <th>email</th>
                                <th>message</th>
                                <th>utilisateur</th>
                                <th>Actions</th>
                            </tr>
                            <tr>
                                <td>{{ $message->firstName }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->message }}</td>
                                @if($message->is_user === 1)
                                    <td>Utilisateur</td>
                                @else
                                    <td>Non inscrit</td>
                                @endif
                                <td>
                                    <button class="btn btn-outline-info">
                                        Repondre
                                    </button>
                                    <button class="btn btn-outline-danger">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
