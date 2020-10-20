@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                @foreach($personal_id as $personal)
                    <div class="card-header text-center">{{ __('Dashboard User ') }} {{ $personal->name }}</div>

                    <div class="card-body">
                        <table class="table">
                                <tr>
                                    <th>Civilité</th>
                                    <th>Prénom et Nom</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                </tr>
                                <tr>
                                    <td>{{ $personal->civility }}</td>
                                    <td>{{ $personal->name }}</td>
                                    <td>{{ $personal->address }}</td>
                                    <td>{{ $personal->phone }}</td>
                                </tr>
                        </table>
                    </div>
                </div>
                @endforeach
                <br>
                @foreach($advertisements as $advertisement)
                    <section class="section">
                        <div class="container" id="user">
                          <div class="row gap-y align-items-center">

                            <div class="col-12 col-md-6">
                              <img class="rounded" style="height: 300px; width: 500px;" data-aos="fade-in" src="{{ asset("uploads/$advertisement->image") }}" alt="..." >
                            </div>


                            <div class="col-12 col-md-6">
                              <h3>{{ $advertisement->name }}</h3>
                              <br>
                              <p>{{ $advertisement->description }}</p>
                              <br>

                              <form action="{{ route('deleteUserPost', $advertisement->id) }}" method="POST">
                                @csrf
                                {{ method_field('POST')}}
                                <button class="btn btn-outline-danger">
                                    Supprimer
                                </button>
                              </form>

                          </div>
                        </div>
                      </section>
                      <br>
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
                @endforeach
                </div>
            </div>
        </div>
    </div>
    {{-- {{ $personals->links() }} --}}
    
@endsection
