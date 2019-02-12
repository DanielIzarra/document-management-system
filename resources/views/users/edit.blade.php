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
            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PATCH') <!-- patch te redirige directamente al método update -->
    
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
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

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
                                        <input type="text" readonly class="col-form-label form-control-plaintext" id="email" value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3 col-sm-12">
                                        <label for="password" class="col-form-label text-md-left">{{ __('Password') }}</label>
                                    </div>
                                    <div class="col-md-9 col-sm-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password">

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
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="card">
                            <div class="card-header"><h4>Companies assignment</h4></div>
                            <div class="card-body">
                                <ul class="list-unstyled" style="height: 195px; overflow-y: auto;">
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
                @role('root')
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h4>User permissions</h4></div>
                            <div class="card-body">
                                <ul class="list-unstyled" style="height: 195px; overflow-y: auto;">
                                    @foreach($permissions as $permission)
                                        @if($permission->isroot == 0)
                                            @php($change = True)
                                            @foreach($checked_permissions as $checked_permission)
                                                @if($permission->id == $checked_permission->id)
                                                    <li title="{{ $permission->description ?: $permission->name }}">
                                                        <label class="form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" checked>
                                                            {{ $permission->name }}
                                                            ({{ $permission->description ?: $permission->name }})
                                                            @php($change = False)
                                                        </label>
                                                    </li>
                                                @endif
                                            @endforeach
                                            @if($change == True)
                                                <li title="{{ $permission->description ?: $permission->name }}">
                                                    <label class="form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                        ({{ $permission->description ?: $permission->name }})
                                                    </label>
                                                </li>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">       
                        <div class="card">
                            <div class="card-header"><h4>User roles</h4></div> 
                            <div class="card-body">
                                <ul class="list-unstyled" style="height: 195px; overflow-y: auto;">
                                    @foreach($roles as $role)
                                        @if($role->name != 'root')
                                            @php($change = True)
                                            @foreach($checked_roles as $checked_role)
                                                @if($role->id == $checked_role->id)
                                                    <li title="{{ $role->description ?: $role->name }}">
                                                        <label class="form-check-inline">
                                                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" checked>
                                                            {{ $role->name }}
                                                            ({{ $role->description ?: $role->name }})
                                                            @php($change = False)
                                                        </label>
                                                    </li>
                                                @endif
                                            @endforeach
                                            @if($change == True)
                                                <li title="{{ $role->description ?: $role->name }}">
                                                    <label class="form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}">
                                                        {{ $role->name }}
                                                        ({{ $role->description ?: $role->name }})
                                                    </label>
                                                </li>
                                            @endif 
                                        @endif                                   
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endrole
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