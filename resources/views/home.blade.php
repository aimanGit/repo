@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" id="loaddata">
            @foreach ($data as $d)
            <div class="card">
                <div class="card-header">{{$d->title}}</div>

                <div class="card-body">
                    {{$d->article}}
                </div>
            </div><br>
            @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        setInterval(timingLoad, 10000);

        function timingLoad(){
            $.ajax({
                url:"{{route('home.second')}}",
                success: function(data){
                    $("div#loaddata").html(data);
                }
            });
        }
    });
</script>
@endsection
