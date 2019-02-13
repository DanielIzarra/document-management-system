@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div>                    
                        <div>
                            @can('create_departments')
                                <a href="{{ route('departments.create')}}" class="btn btn-sm btn-primary float-right">create department</a>
                            @endcan                
                        </div>
                        <br><br>
                        @if(isset($departments))
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="50px">id</th>
                                        <th>Name</th>
                                        <th colspan="4" class="col-md-2">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $department)
                                        <tr>
                                            <td>{{ $department->id }}</td>
                                            <td>{{ $department->name }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else 
                            <span class="border-left">No tiene asignado ningún departamento.</span>
                        @endif                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection