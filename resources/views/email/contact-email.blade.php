<h1 style="text-align: center">BDoctors</h1>
<p>Hai ricevuto un nuovo messaggio da:</p>
<ul>
    <li>{{$lead->last_name }}, {{$lead->name}}</li>
    <li><strong>@</strong>: {{ $lead->email }}</li>
    <li>{{$lead->subject}}</li>
</ul>
<p><strong style="color:brown">Il messaggio</strong>:</p>
<p><strong>"</strong> {{$lead->message}} <strong>"</strong></p>