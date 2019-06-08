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
                        <a href="{{ route('repositories.upload') }}" class="btn btn-sm btn-primary float-right">Upload Document</a>
                    </div>
                    <br><br>
                    <div>
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="50px">id</th>
                                    <th>Name</th>
                                    <th colspan="4" class="col-md-1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $template)
                                    @if($template->delete == 0)
                                    <tr>
                                        <td>{{ $template->id }}</td>
                                        <td>{{ $template->filename }}</td> 
                                        <td>
                                            <a href="{{ route('repositories.download', $template->id) }}" class="btn btn-sm btn-outline-primary">Download</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('repositories.destroy', $template->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
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