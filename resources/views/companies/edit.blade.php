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
            <form method="POST" action="{{ route('companies.update', $company) }}">
                @csrf
                @method('PATCH') <!-- patch te redirige directamente al método update -->
    
                <div class="form-row"> 
                    <div class="col-md-12">       
                        <div class="card">
                            <div class="card-header"><h4>Company data</h4></div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Name') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $company->name }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $company->email }}">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="denomination" class="col-md-12 col-form-label text-md-left">{{ __('Denomination') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="denomination" type="text" class="form-control{{ $errors->has('denomination') ? ' is-invalid' : '' }}" name="denomination" value="{{ $company->denomination }}">

                                        @if ($errors->has('denomination'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('denomination') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="cif" class="col-md-12 col-form-label text-md-left">{{ __('CIF') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="cif" type="text" readonly class="col-form-label form-control-plaintext" value="{{ $company->cif }}">
                                    </div>
                                </div>                                
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