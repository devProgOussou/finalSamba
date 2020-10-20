@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Veuillez completez vos informations ')}}
                        <strong>{{ Auth::user()->name }}</strong></div>

                    <div class="card-body">
                        <form action="{{ route('userRegister', \Illuminate\Support\Facades\Auth::id())}}" method="POST">
                            @csrf
                            {{method_field('POST')}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Civilité</label>

                                <div class="col-md-6">
                                    <select name="civility" class="custom-select">
                                        <option value="M">Homme</option>
                                        <option value="F">Femme</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="typeOfuser"
                                       class="col-md-4 col-form-label text-md-right">{{ __('type') }}</label>

                                <div class="col-md-6">
                                    <label>
                                        <select name="is_company" class="custom-select">
                                            <option value= {{ true }}>Entreprise</option>
                                            <option value={{ false }}>Personnel</option>
                                        </select>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nom complet</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">Nom Entreprise(facultatif)</label>

                                <div class="col-md-6">
                                    <input id="company" type="text"
                                           class="form-control @error('company') is-invalid @enderror" name="company"
                                           value="{{ old('company') }}" autocomplete="company" autofocus placeholder="facultatif">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Adresse</label>

                                <div class="col-md-6">
                                    <input type="text" name="address"
                                           class="form-control @error('address') is-invalid @enderror"
                                           value="{{ old('address') }}" required>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Téléphone</label>

                                <div class="col-md-6">
                                    <input type="text" name="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-success">
                                        {{ __('Enregistrer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
