@extends('layouts.app')

@section('content')
    <div class="container" id="advertisement">
        <div class="row justify-content-center">
            @foreach ($annonces as $annonce)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-hover-shadow">
                        <img class="card-img-top" src="uploads/{{ $annonce->image }}" alt="Card image cap">
                        <div class="card-block bg-dark text-light">
                            <h4 class="card-title text-center">{{ $annonce->name }}</h4>
                            <p class="card-text text-center">{{ $annonce->description }}</p>

                            <a href="{{ route('showDeal', $annonce->id) }}" style="margin-left: 7em;">
                                <button class="btn btn-info m-3">
                                    Consulter
                                </button>
                            </a>
                        </div>
                    </div>
                    <br>
                </div>
        @endforeach
        <script language="javascript" type="text/javascript">
            var timeout = setTimeout(reloadPage, 10000);
            var chemin = window.location.pathname;
            function reloadPage () {
                $('#advertisement').load(`${chemin} #advertisement`,function () {
                    $(this).unwrap();
                    timeout = setTimeout(reloadPage, 10000);
                });
            }
        </script>
    </div>
</div>
   {{-- <div style="margin-left: 38em;">{{ $annonces->links() }}</div> --}}
@endsection
