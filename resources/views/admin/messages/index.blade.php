@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center fw-bold">Area messaggi</h1>
            </div>
        </div>
        <div class="row">
        <div class="col-12">
            
            @if($messages->isEmpty())
                <p class="text-center my-4 text-danger fs-5">Non ci sono messaggi da visualizzare.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Email</th>
                            <th>Contenuto del messaggio</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->surname }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->content }}</td>
                                <td>{{ $message->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
