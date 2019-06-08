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
                <div class="card-header"><h4>User documents</h4></div>
                <div class="card-body">
                    <div>
                        <a href="{{ route('documents.upload', $user->id) }}" class="btn btn-sm btn-primary float-right">Upload Document</a>
                    </div>
                    <br><br>
                    <div id="">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="50px">id</th>
                                    <th>Documents name</th>
                                    <th colspan="5" class="col-md-1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user_documents as $document)
                                    @if($document->delete == 0)
                                    <tr>
                                        <td>{{ $document->id }}</td>
                                        <td name="filename">{{ $document->filename }}</td>
                                        <td bgcolor="<?php echo $document->state['colour']; ?>"></td>
                                        <td>
                                            <form name="states" action="{{ route('documents.state_assign', $document->id) }}" method="POST">
                                                @csrf

                                                <select name="state_id" onchange="this.form.submit();">
                                                    <option value="" disabled selected>Select status</option>
                                                    @foreach($states as $state)
                                                        <option value="<?php echo $state['id']; ?>">{{ $state->name }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="http://localhost/docms/storage/app/{{ $document->uri }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
                                        </td> 
                                        <td>
                                            <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-outline-primary">Download</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST">
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
    <br>
    <form method="POST" action="{{ route('documents.store_assign', $user->id) }}">
        @csrf

        @if($name[0]->isroot == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Templates assignment</h4></div>
                    <div class="card-body">
                        <ul class="list-unstyled" style="height: 400px; overflow-y: auto;">
                            @foreach($templates as $template)
                                <li>
                                    <label class="form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="templates[]" value="{{ $template->id }}">
                                        {{ $template->filename }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @else
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Documents assignment</h4></div>
                    <div class="card-body">
                        <ul class="list-unstyled" style="height: 400px; overflow-y: auto;">
                            @foreach($documents_to_assign as $document)
                                @if($document->delete == 0)
                                    <li>
                                        <label class="form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="documents_to_assign[]" value="{{ $document->id }}">
                                            {{ $document->filename }}
                                        </label>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <br>
        <div class="col-md-1 offset-md-11">
            <button type="submit" class="btn btn-primary">
                {{ __('Save') }}
            </button>
        </div>
    </form>
</div>
@endsection