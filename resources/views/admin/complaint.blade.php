<h1>Complaints</h1>

@foreach($complaints as $c)
    <p>
        User: {{ $c->user_name }} <br>
        Message: {{ $c->message }} <br>
        Status: {{ $c->status }}
    </p>
    <hr>
@endforeach