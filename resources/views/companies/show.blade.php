@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <strong><label for="name" class="col-md-12 col-form-label text-md-left">{{ __('Name') }}</label></strong>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <input type="text" readonly class="col-form-label form-control-plaintext" id="name" value="{{ $company->name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <strong><label for="email" class="col-md-12 col-form-label text-md-left">{{ __('E-Mail Address') }}</label></strong>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <input type="text" readonly class="col-form-label form-control-plaintext" id="email" value="{{ $company->email }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <strong><label for="denomination" class="col-md-12 col-form-label text-md-left">{{ __('Denomination') }}</label></strong>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <input type="text" readonly class="col-form-label form-control-plaintext" id="denomination" value="{{ $company->denomination }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <strong><label for="cif" class="col-md-12 col-form-label text-md-left">{{ __('CIF') }}</label></strong>
                        </div>
                        <div class="col-md-7 col-sm-12">
                            <input type="text" readonly class="col-form-label form-control-plaintext" id="cif" value="{{ $company->cif }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection