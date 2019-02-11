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
            <form method="POST" action="{{ route('companies.store_assign_companies', $user) }}">
                @csrf
    
                <div class="form row">
                    <div class="col-md-12"> 
                        <div class="card">
                            <div class="card-header"><h4>Companies assignment</h4></div>
                            <div class="card-body">
                                <ul class="list-unstyled" style="height: 400px; overflow-y: auto;">
                                    @foreach($companies as $company)
                                        @php($change = True)
                                        @foreach($checked_companies as $checked_company)
                                            @if($company->id == $checked_company->id)
                                            <li>
                                                <label class="form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="companies[]" value="{{ $company->id }}" checked>
                                                    {{ $company->name }}
                                                    @php($change = False)
                                                </label>
                                            </li>
                                            @endif
                                        @endforeach
                                        @if($change == True)
                                        <li>
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="companies[]" value="{{ $company->id }}">
                                                {{ $company->name }}
                                            </label>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-1 offset-md-11">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection