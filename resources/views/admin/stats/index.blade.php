@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row mt-2">
        <div class="col-12">
            <h1>Le tue Statistiche</h1>
            <p>Questa è la pagina delle statistiche. La pagina funziona correttamente.</p>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <a href="{{route('admin.dashboard')}}" class="back text-decoration-none">Torna alla dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection