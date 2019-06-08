@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>                    
        </div>
    @endif 
    <div class="row">
        <div class="col-md-12">            
            <div class="card">
                <div class="card-body">
                    <div>
                        <a href="{{ route('documents.upload', $user->id) }}" class="btn btn-sm btn-primary float-right">Upload Document</a>
                    </div>
                    <br><br>
                    <div>
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Documents name</th>
                                    <th colspan="4" class="col-md-1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_documents as $document)
                                    @if($document->delete == 0)
                                    <tr>
                                        <td>{{ $document->filename }}</td> 
                                        <td>
                                            <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-outline-primary">Download</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>           
        </div>
    </div>
</div>
@endsection