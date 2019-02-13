@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div>                    
                        <div>
                            @can('create_delegations')
                                <a href="{{ route('delegations.create')}}" class="btn btn-sm btn-primary float-right">create delegation</a>
                            @endcan                
                        </div>
                        <br><br>
                        @if(isset($delegations))
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="50px">id</th>
                                        <th>Name</th>
                                        <th colspan="4" class="col-md-2">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($delegations as $delegation)
                                        <tr>
                                            <td>{{ $delegation->id }}</td>
                                            <td>{{ $delegation->name }}</td>

                                            <td>
                                                @can('index_users_delegation')
                                                    <a href="{{ route('delegations.index_users_delegation', $delegation->id) }}" class="btn btn-sm btn-outline-dark float-right">Users</a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('show_delegations')
                                                    <a href="{{ route('delegations.show', $delegation->id) }}" class="btn btn-sm btn-outline-dark float-right">Info</a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('edit_delegations')
                                                    <a href="{{ route('delegations.edit', $delegation->id) }}" class="btn btn-sm btn-outline-dark float-right">Edit</a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('destroy_delegations')
                                                    <form action="{{ route('delegations.destroy', $delegation->id) }}"  method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger float-right" type="submit">Delete</button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else 
                            <span class="border-left">No tiene asignada ninguna delegación.</span>
                        @endif                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection