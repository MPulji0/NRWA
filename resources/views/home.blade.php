@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="mb-4">{{ __('You are logged in!') }}</p>

                    <div class="d-flex">
                        <a href="{{ url('/customers') }}" class="btn btn-primary me-3">{{ __('Customers') }}</a>
                        <a href="{{ url('/contacts') }}" class="btn btn-primary me-3">{{ __('Contacts') }}</a>
                        <a href="{{ url('/employees') }}" class="btn btn-primary">{{ __('Employees') }}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
