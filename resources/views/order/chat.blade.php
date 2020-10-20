@extends('layouts.app')
@section('content')
    @foreach($order as $orderProduct)
        <div class="container">
        <form action="{{ route('sendMessage', $orderProduct->id) }}" method="POST">
            @endforeach
            @csrf
            {{ method_field('POST') }}
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="sender_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
            <input type="hidden" name="receiver_id" value="{{ $orderProduct->user_id }}">
            <div class="form-group row">
                @foreach($userPost as $user)
                <input type="hidden" name="userReceive" value="{{ $user->name }}">
                    <h2 class="col-md-12 text-center">Message a : {{ $user->name }}</h2>
                    <label>
                        <textarea cols="30" rows="10" name="message"
                                  class="col-md-12 @error('message') is-invalid @enderror" required
                                  style="margin-left: 17rem;">{{ old('message') }}</textarea>
                    </label>
                    @error('message')
                    <strong>
                        <span class="invalid-feedback">{{ $message }}</span>
                    </strong>
                    @enderror
            </div>
            <button style="margin-left: 30rem;" class="btn btn-outline-success">
                SEND MESSAGE
            </button>
        </form>
        </div>
    @endforeach
@endsection
