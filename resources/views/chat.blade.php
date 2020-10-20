{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                        <div class="card-header text-center">{{ __('Dashboard Message') }}</div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>Message de </th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach ($messages as $message)
                                <tr>
                                    <td>
                                        <p class="lead">{{ $message->name }}</p>
                                    </td>
                                    <td>
                                        {{ $message->message }}
                                    </td>
                                    <td>
                                        <a href="{{ route('response', $message->sender_id) }}">
                                            <button class="btn btn-outline-info">
                                                Repondre
                                            </button>
                                        </a>

                                        <a href="{{ route('deleteMessage', $message->id) }}">
                                            <button class="btn btn-outline-danger">
                                                supprimer
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
    {{-- {{ $personals->links() }} --}}
{{-- @endsection --}} 

<!-- resources/views/chat.blade.php -->

{{-- @extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>

                <div class="panel-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Messages</h2>

            <div
                class="clearfix"
                v-for="message in messages"
            >
                @{{ message.user.name }}: @{{ message.message }}
            </div>

            <div class="input-group">
                <input
                    type="text"
                    name="message"
                    class="form-control"
                    placeholder="Ecrivez votre message ici..."
                    v-model="newMessage"
                    @keyup.enter="sendMessage"
                >

                <button
                    class="btn btn-primary"
                    @click="sendMessage"
                >
                    Envoyer
                </button>
            </div>
        </div>
    </div>
</div>
@endsection