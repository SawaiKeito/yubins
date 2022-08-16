@extends('layouts.app')

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

                    <a href="{{ asset('/yubins') }}" class="btn btn-outline-secondary" role="button">
                       <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
                    </a>
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
