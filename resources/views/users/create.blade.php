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
            <form method="POST" action="{{ route('users.store') }}">
                 @csrf 
                 <div class="form-row"> 
                    <div class="col-md-6">          
                        <div class="card">
                                <div class="card-header"><h4>User profile data</h4></div>
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
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="password" class="col-form-label text-md-left">{{ __('Password') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="password-confirm" class="col-form-label text-md-left">{{ __('Confirm Password') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">       
                        <div class="card">
                            <div class="card-header"><h4>User roles</h4></div> 
                            <div class="card-body">
                                <ul class="list-unstyled" style="height: 195px; overflow-y: auto;">  
                                    @foreach($allroles as $role)
                                        @if($role->name != 'root')
                                        <li title="{{ $role->description ?: $role->name }}">
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"
                                                @if (in_array($role->id, old('roles', []))) checked @endif>
                                                {{ $role->name }}
                                                ({{ $role->description ?: $role->name }})                                      
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
                <div class="form-row">
                    <div class="col-md-6">          
                        <div class="card">
                            <div class="card-header"><h4>Companies assignment</h4></div>
                            <div class="card-body">
                                <ul class="list-unstyled" style="height: 195px; overflow-y: auto;">
                                    @foreach($companies as $company)
                                        <li>
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="companies[]" value="{{ $company->id }}"
                                                @if (in_array($company->id, old('companies', []))) checked @endif>
                                                {{ $company->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">          
                        <div class="card">
                            <div class="card-header"><h4>Delegations assignment</h4></div>
                            <div class="card-body">
                                <ul class="list-unstyled" style="height: 195px; overflow-y: auto;">
                                    @foreach($delegations as $delegation)
                                        <li>
                                            <label class="form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="delegations[]" value="{{ $delegation->id }}"
                                                @if (in_array($delegation->id, old('delegations', []))) checked @endif>
                                                {{ $delegation->name }}
                                            </label>
                                        </li>
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