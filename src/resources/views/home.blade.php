@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>Welcome {{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                        <p><strong>Email:</strong> {{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                        <p><strong>Role:</strong> {{\Illuminate\Support\Facades\Auth::user()->role->name}}</p>
                        <p><strong>Created at:</strong> {{\Illuminate\Support\Facades\Auth::user()->created_at}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
