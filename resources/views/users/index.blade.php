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
                    <div>
                        @include('partials.searcher', ['whatWeSearch' => 'user'])
                        @if(isset($company))
                            @can('create_user_company')
                                <a href="{{ route('users.create_user_company', $company) }}" class="btn btn-sm btn-primary float-right">create company user</a>
                            @endcan
                        @endif
                        @if(isset($delegation))
                            @can('create_user_delegation')
                                <a href="{{ route('users.create_user_delegation', $delegation) }}" class="btn btn-sm btn-primary float-right">create delegation user</a>
                            @endcan
                        @endif
                        @if(isset($department))
                            @can('create_user_department')
                                <a href="{{ route('users.create_user_department', $department) }}" class="btn btn-sm btn-primary float-right">create department user</a>
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
                                    <th colspan="5" class="col-md-1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @can('assign_admin_companies')
                                            <a href="{{ route('companies.create_assign_companies', $user->id) }}" class="btn btn-sm btn-outline-dark float-right">Assign Com.</a>
                                        @endcan
                                    </td>
                                    <td>
                                        <a href="{{ route('documents.index', $user->id) }}" class="btn btn-sm btn-outline-dark float-right">Documents</a>
                                    </td>
                                    <td>
                                        @can('show_users')
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-dark float-right">Info</a>
                                        @endcan
                                    </td> 
                                    <td>
                                        @can('edit_users')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-dark float-right">Edit</a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('destroy_users')
                                            <form action="{{ route('users.destroy', $user->id) }}"  method="POST">
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
@endsection
