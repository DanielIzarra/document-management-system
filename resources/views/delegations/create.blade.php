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
            <form method="POST" action="{{ route('delegations.store') }}">
                @csrf 
<<<<<<< Updated upstream
                <div class="form-row"> 
                    <div class="col-md-6">          
=======
<<<<<<< Updated upstream
                <div class="form-row"> 
                    <div class="col-md-6">          
=======
                <div class="form-row">
                    <div class="col-md-12">          
>>>>>>> Stashed changes
>>>>>>> Stashed changes
                        <div class="card">
                            <div class="card-header"><h4>Delegation data</h4></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="name" class="col-form-label text-md-left">{{ __('Name') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="email" class="col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< Updated upstream
=======
<<<<<<< Updated upstream
>>>>>>> Stashed changes
                    <div class="col-md-6">          
                        <div class="card">
                            <div class="card-header"><h4>Companies assignment</h4></div>
                            <div class="card-body">
                                <select name="company">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
<<<<<<< Updated upstream
=======
=======
                </div>
                <br>
                <input type="hidden" name="company_id" value="{{ $company->id }}">
>>>>>>> Stashed changes
>>>>>>> Stashed changes
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