@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('List Newsletter') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="#" style="float: right;" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a><br><br>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Article</th>
                                <th>Status</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <?php
                            $i=0;
                        ?>
                        <tbody id="loaddata">
                        @foreach ($nl as $n)
                        <tr>
                            <td>{{ $n->title }}</td>
                            <td>{{ $n->article }}</td>
                            <td>
                                @if($n->deleted_at > now() || $n->deleted_at == null)
                                    <span class="badge rounded-pill bg-success">Active</span>
                                @elseif($n->deleted_at < now())
                                    <span class="badge rounded-pill bg-danger">Deleted</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('list.edit',$n->id)}}" class="btn btn-primary btn-sm" style="margin-bottom: 1px; width: 30px;"><i class="fa fa-pencil" aria-hidden="true"></i></a><br>

                                <!-- <a href="#" class="btn btn-primary btn-sm" style="margin-bottom: 1px; width: 30px;"><i class="fa fa-eye" aria-hidden="true"></i></a><br> -->

                                @if($n->deleted_at > now() || $n->deleted_at == null)
                                    <button type="submit" style="width: 30px;" onclick="dltnl('{{$n->id}}','{{$n->title}}')" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                @else
                                    <a href="{{route('list.republish',$n->id)}}" style="width: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Re-Publish Newsletter" class="btn btn-success btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Newsletter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{route('list.add')}}" name="addNlForm">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <textarea class="form-control" name="title" placeholder="Autem est atque et corrupti assumenda eligendi." rows="2" required></textarea>
                </div>

                <div class="form-group">
                    <label for="title">Article</label>
                    <textarea class="form-control" name="article" rows="10" placeholder="Vitae voluptatem non aliquam omnis itaque aut. Possimus quia consequuntur praesentium velit est. Esse quia ullam id qui assumenda deserunt ullam. Vel quaerat dolores fuga eum consequuntur. Vel repudiandae sit quia culpa. Qui deleniti in ut..." required></textarea>
                </div><br>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Newsletter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Delete <b><span id="titledlt"></b></span>?

            <form method="post" action="{{route('list.delete')}}" name="dltform">
                {{csrf_field()}}
                <input type="hidden" id="iddlt" name="iddlt">
                <br>
                <button type="submit" style="margin: 1px;" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >No</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
    function dltnl(id,title){

        document.getElementById("titledlt").innerHTML = title;
        document.getElementById("iddlt").value = id;
    }

    $(document).ready(function(){
        setInterval(timingLoad, 10000);

        function timingLoad(){
            $.ajax({
                url:"{{route('list.second')}}",
                success: function(data){
                    $("tbody#loaddata").html(data);
                }
            });
        }
    });
</script>

@endsection
