@extends('layouts.app')
@section('content')
    @foreach($messages as $message)
        @foreach($messageSent as $messageSend)
        <div class="container">
            <div class="container" id="messages">
                <div class="row">
                    <div class="co-md-12" style="margin-left: 20rem;">
                        @if($messageSend->name === Auth::user()->name)
                        @else
                        <span id="nameReceiver">{{ $messageSend->name }}</span> : <span id=messageSend>{{ $messageSend->message }}</span>
                        @endif
                        <br>
                        <span id="nameSender">{{ $message->name }}</span> : <span id="messageReceive">{{ $message->message }}</span>
                    </div>
                </div>
            </div>
        <form action="{{ route('sendResponse', $message->id) }}" method="POST" id="envoie">
            @endforeach
            @endforeach
            @csrf
            {{ method_field('POST') }}
            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            <input type="hidden" name="sender_id" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
            <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">
            @foreach($userReceiver as $user)
            <input type="hidden" value="{{ $message->name }}" name="userReceive">
            <div class="form-group row">
                    <h2 class="col-md-12 text-center">Reponse pour : {{ $message->name }}</h2>
                    <label>
                        <textarea cols="30" rows="10" name="message" class="col-md-12 @error('message') is-invalid @enderror" required style="margin-left: 17rem;">{{ old('message') }}</textarea>
                    </label>
                    @error('message')
                    <strong>
                        <span class="invalid-feedback">{{ $message }}</span>
                    </strong>
                    @enderror
            </div>
            <button style="margin-left: 30rem;" class="btn btn-outline-success" id="envoie">
                SEND MESSAGE
            </button>
        </form>
        </div>
        <script>
            $('#envoi').click(function(e){
                e.preventDefault();
    
                var nameReceiver = encodeURIComponent(
                $('#nameReceiver').val());

                var messageSend = encodeURIComponent(
                $('#messageSend').val());

                var nameSender = encodeURIComponent(
                $('#nameSender').val());

                var messageReceive = encodeURIComponent(
                $('#messageReceive').val());
                
                var chemin = window.location.pathname;

                var message = encodeURIComponent(
                    $('#message').val());
                        $.ajax({
                            url: `${chemin}`,
                            type: 'post',
                            data: "nameReceiver" + nameReceiver + "messageSend" + messageSend + "nameSender" + nameSender + "&message" + message
                        });
                        $('#message').append('<p>'+pseudo+'a dit '+ message);
            });
    @endforeach
@endsection
