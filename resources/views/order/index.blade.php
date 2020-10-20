@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <section class="section bg-gray">
                <div class="container">
                    @foreach ($commandes as $commande)
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">

                                <article class="mt-90">
                                    <header class="text-center mb-40">
                                        <h3>{{ $commande->name }}</h3>
                                    </header>

                                    <img class="rounded" style="height: 400px; width:550px;"
                                         src="{{ asset("uploads/$commande->image") }}" alt="...">

                                    <div class="card-block">

                                        <p class="text-justify m-2">{{ $commande->description }}</p>

                                        <form action="{{ route('makeOrder', $commande->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('POST') }}
                                            <button class="btn btn-info">
                                                Commander
                                            </button>
                                        </form>
                                    </div>
                                </article>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
    {{-- <div style="margin-left: 38em;">{{ $commandes->links() }}</div>
    --}}
@endsection
