@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-end">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <p><strong>Nombre:</strong>  {{ $user->name }}</p>
                    <p><strong>Email:</strong>  {{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection