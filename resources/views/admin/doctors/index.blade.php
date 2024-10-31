<div class="container">
    <div class="row">
        <div class="col-12">
            @foreach ($doctors as $doctor)
            <h2>{{ $doctor->user_name }}</h2>
            <h2>{{ $doctor->user_surname }}</h2>
            <h2>{{ $doctor->city }}</h2>
            <h2>{{ $doctor->address }}</h2>
            <h2>{{ $doctor->phone_number }}</h2>
            <h2>{{ $doctor->performance }}</h2>
            @endforeach
        </div>
    </div>
</div>