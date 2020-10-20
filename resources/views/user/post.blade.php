@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">{{ __('Veuillez completez vos informations ')}}
                        <strong>{{ Auth::user()->name }} Type
                            : {{ Auth::user()->is_company === 1 ? "Entreprise" : "Personnel"}}</strong></div>

                    <div class="card-body">
                        <form action="{{ route('makeAdvertisement') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <input name="user_id" type="hidden" value="{{ Auth::id() }}">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nom du produit</label>

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
                                <label for="address" class="col-md-4 col-form-label text-md-right">Image</label>

                                <div class="col-md-6">
                                    <input type="file" name="image"
                                           class="form-control @error('image') is-invalid @enderror"
                                           value="{{ old('image') }}" required>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea name="description" id="description" cols="30" rows="10"
                                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">Categorie</label>

                                <div class="col-md-6">
                                    <select name="categories" class="custom-select">
                                        <option value="pantalon">PANTALON</option>
                                        <option value="tshirt">Tee shirt</option>
                                        <option value="telephone">Telephone</option>
                                    </select>
                                </div>
                            </div>
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
