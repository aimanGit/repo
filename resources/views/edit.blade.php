@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Newsletter') }}</div>

                <div class="card-body">
                	@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{route('list.update',$data[0]->id)}}" name="nlform">

                    	{{csrf_field()}}

	            		<div class="row">
	            			<div class="col-md-6">
	            				<div class="form-group">
			            			<label for="title">Article</label>
			            			<textarea class="form-control" name="article" rows="10" required>{{$data[0]->article}}</textarea>
			            		</div>
	            			</div>
	            			<div class="col-md-6">
	            				<div class="form-group">
			            			<label for="title">Title</label>
			            			<textarea class="form-control" name="title" rows="2" required>{{$data[0]->title}}</textarea>
			            		</div>

			            		<br><button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
	            			</div>
	            		</div>
	            	</form>
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection