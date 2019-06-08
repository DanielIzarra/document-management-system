@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div>                    
                        <div>
                            @include('partials.searcher', ['whatWeSearch' => 'department'])
                            @if(isset($company))
                                @can('create_department_company')
                                    <a href="{{ route('departments.create_department_company', $company)}}" class="btn btn-sm btn-primary float-right">create company department</a>
                                @endcan
                            @endif
                            @if(isset($delegation))
                                @can('create_department_delegation')
                                    <a href="{{ route('departments.create_department_delegation', $delegation)}}" class="btn btn-sm btn-primary float-right">create delegation department</a>
                                @endcan
                            @endif
                        </div>
                        <br><br>
                        <div>
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

                                            <td>
                                                @can('index_users_department')
                                                    <a href="{{ route('departments.index_users_department', $department->id) }}" class="btn btn-sm btn-outline-dark float-right">Users</a>
                                                @endcan
                                            </td>

                                            <td>
                                                @can('show_departments')
                                                    <a href="{{ route('departments.show', $department->id) }}" class="btn btn-sm btn-outline-dark float-right">Info</a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('edit_departments')
                                                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-outline-dark float-right">Edit</a>
                                                @endcan
                                            </td>
                                            <td>
                                                @can('destroy_departments')
                                                    <form action="{{ route('departments.destroy', $department->id) }}"  method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection