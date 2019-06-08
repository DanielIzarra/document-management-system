@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-10">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                    
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('documents.store', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group row">
                                    <input type="file" class="form-control{{ $errors->has('file.*') ? ' is-invalid' : '' }}" name="file[]" multiple required>
                                    
                                    @if ($errors->has('file.*'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file.*') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <a href="{{ route('documents.index', $user->id)}}" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>           
        </div>
    </div>
</div>
@endsection