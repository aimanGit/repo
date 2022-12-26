@foreach ($data as $d)
<div class="card">
    <div class="card-header">{{$d->title}}</div>

    <div class="card-body">
        {{$d->article}}
    </div>
</div><br>
@endforeach