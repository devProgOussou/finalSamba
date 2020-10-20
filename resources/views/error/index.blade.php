@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">

                        <h1 class="text-center">VOUS AVEZ ETE DESACTIVER PAR L'ADMINISTRATEUR</h1>
                        <h3 class="text-center">Voulez-vous contacter l'administrateur :
                            <a href="" class="" data-toggle="modal"
                                    data-target="#staticBackdrop">
                                <u>Contact</u>
                            </a>
                        </h3>
                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                             tabindex="-1"
                             aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Contact</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body bg-dark text-light">


                                        <form action="{{ route('submitContact') }}"
                                              method="POST">
                                            @csrf
                                            {{method_field('POST')}}
                                            <input type="hidden" value="{{ Auth::user()->name }}" name="firstName">
                                            <input type="hidden" value="{{ Auth::user()->email }}" name="email">
                                            <div class="form-group row">
                                                <label for="object"
                                                       class="col-md-4 col-form-label text-md-right">Objet</label>

                                                <div class="col-md-6">
                                                    <input type="text" name="object"
                                                           class="form-control @error('object') is-invalid @enderror"
                                                           value="{{ old('object') }}" required>
                                                    @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-md-4 col-form-label text-md-right">Message</label>

                                                <div class="col-md-6">
                                                    <textarea name="message"
                                                              class="form-control @error('phone') is-invalid @enderror"
                                                              id="" cols="30" rows="10">{{ old('message') }}</textarea>
                                                    @error('message')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" name="is_user" value="{{ true }}">
                                            <div class="justify-content-center">
                                                <button type="submit" class="btn btn-outline-success">
                                                    Envoyer
                                                </button>
                                            </div>
                                        </form>


                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        Formulaire de contact
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
