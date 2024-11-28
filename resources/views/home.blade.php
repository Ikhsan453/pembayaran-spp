@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->role == 1)
                        {{ __('You are logged in as admin') }}
                    @elseif (Auth::user()->role == 2)
                        {{ __('You are logged in as petugas') }}
                    @elseif (Auth::user()->role == 3)
                        {{ __('You are logged in as siswa') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
