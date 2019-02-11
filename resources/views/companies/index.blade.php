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
                        @can('users_create')
                            <a href="{{ route('companies.create')}}" class="btn btn-sm btn-primary float-right">create company</a>
                        @endcan                
                    </div>
                    <br><br>
                    <div>
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="50px">id</th>
                                    <th>Name</th>
                                    <th colspan="3" class="col-md-1">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>
                                        @can('companies_show')
                                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-sm btn-outline-dark float-right">Info</a>
                                        @endcan
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $companies->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
