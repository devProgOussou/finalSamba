@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="admin">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <br>
                        <div class="offset-3">
                            <form action="{{ route('showCompany') }}" method="POST">
                                @csrf
                                {{ method_field('POST') }}
                                <button class="btn btn-primary">
                                    Show Companies
                                </button>
                            </form>
                            <form action="{{ route('showUser') }}" method="POST" class="offset-5"
                                  style="margin-top: -2rem;">
                                @csrf
                                {{ method_field('POST') }}
                                <button class="btn btn-secondary">
                                    Show Personals
                                </button>
                            </form>
                        </div>
                        <br>
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Statut</th>
                                <th>Etat</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @if($user->is_admin === 1)
                                        <td>Administrateur</td>
                                    @else
                                        <td>Utilisateur</td>
                                    @endif
                                    @if($user->is_active === 1)
                                        <td>Actif</td>
                                    @else
                                        <td>Inactif</td>
                                    @endif
                                    @if($user->is_company === 1)
                                        <td>Entreprise</td>
                                    @else
                                        <td>Particulier</td>
                                    @endif
                                    <td>
                                        <div>
                                            <a href="{{ route('admin.show', $user->id) }}" style="margin-right: 7rem;">
                                                <button type="button" class="btn btn-outline-info">Afficher</button>
                                            </a>
                                            @if($user->is_active === 1)
                                                <form action="{{ route('makeunactive', $user->id) }}" method="POST"
                                                      style="margin-left: 6rem; margin-top: -2.4rem;">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button v-on:click.prevent="click" type="submit" class="btn btn-outline-warning">
                                                        Desactiver
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('makeactive', $user->id) }}" method="POST"
                                                      style="margin-left: 6rem; margin-top: -2.4rem;">
                                                    @csrf
                                                    {{ method_field('PUT') }}
                                                    <button  v-on:click.prevent="click" type="submit" class="btn btn-outline-success">
                                                        Activer
                                                    </button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                                    data-target="#staticBackdrop"
                                                    style="margin-left: 13rem; margin-top: -4rem;">
                                                SUPPRIMER
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                     tabindex="-1"
                                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h2>Attention vous allez supprimer un utilisateur</h2>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-success"
                                                        data-dismiss="modal">
                                                    ANNULER
                                                </button>
                                                <a href="" onclick="event.preventDefault();
                                                     document.getElementById('delete').submit();">
                                                    <button type="button" class="btn btn-outline-danger">CONFIRMER
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form id="delete" action="{{ route('admin.destroy', $user->id) }}" method="POST"
                                      class="float-right">
                                    @csrf
                                    {{ method_field("DELETE") }}
                                </form>
                            @endforeach
                        </table>
                        <div style="margin-left: 35em;">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script language="javascript" type="text/javascript">
        var timeout = setTimeout(reloadPage, 10000);
        var chemin = window.location.pathname;
        function reloadPage () {
            $('#user').load(`${chemin} #user`,function () {
                $(this).unwrap();
                timeout = setTimeout(reloadPage, 10000);
            });
        }
    </script>

@endsection
