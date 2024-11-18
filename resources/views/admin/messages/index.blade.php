@extends('layouts.app')
@section('title', 'BD - Inbox')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center fw-bold mb-3" style="color: #005792">Messaggi dei pazienti</h1>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-12">
                @if($messages->isEmpty())
                    <p class="text-center my-4 text-danger fs-5">Non ci sono messaggi da visualizzare.</p>
                @else
                <ol>
                    @foreach($messages as $message)
                        <div class="card mb-4 messages-box">
                            <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                                <div class="d-flex flex-column flex-wrap flex-md-row info-user">
                                    <li class="ms-3">
                                        {{-- <h6 class="text-danger id">(#{{$message->id}})</h6> --}}
                                        <h5 class="card-title mb-0 ms-3">Da: <strong>{{$message->name}} {{$message->surname}}</strong></h5>
                                        <p class="card-text ms-3 mb-0">Email: <strong class="email">{{$message->email}}</strong></p>
                                    </li>
                                </div>
                                <div>
                                    <p class="card-text mb-0 ms-3">{{$message->created_at->format('d-m-Y H:i')}}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text m-3"><strong>"</strong> {{$message->content}} <strong>"</strong> </p>
                            </div>
                        </div>
                    @endforeach
                </ol>
                @endif
            </div>
            <div class="col-12">
                <div class="d-flex justify-content-center"><a href="{{route('admin.dashboard')}}" class="back text-decoration-none">Torna alla dashboard</a></div>
            </div>
        </div>
@endsection
