@extends('layout')

@section('content')
<div class="container small">
  <h1>新規情報登録</h1>
  <form action="{{ asset('/show') }}" method="POST">
  @csrf
    <fieldset>
        <div class="form-group">
            
            <label for="name">{{ __('お名前') }}</label>
            <input type="text" class="form-control" name="name" id="name">
             <div class="alert alert-danger">
          @error('name')
             <div class="alert alert-danger">{{ $message }}</div>
          @enderror
         </div>
            
             <label for="name">{{ __('郵便番号') }}</label>
            <input type="text" class="form-control" name="post7" id="post7">
             <div class="alert alert-danger">
          @error('name')
             <div class="alert alert-danger">{{ $message }}</div>
          @enderror
         </div>
            
             <label for="name">{{ __('住所') }}</label>
            <input type="text" class="form-control" name="address" id="address">
             <div class="alert alert-danger">
          @error('address')
             <div class="alert alert-danger">{{ $message }}</div>
          @enderror
         </div>
            
             <label for="name">{{ __('電話番号') }}</label>
            <input type="text" class="form-control" name="tell" id="tell">
             <div class="alert alert-danger">
          @error('tell')
             <div class="alert alert-danger">{{ $message }}</div>
          @enderror
         </div>
            
             <label for="name">{{ __('携帯電話番号') }}</label>
            <input type="text" class="form-control" name="phone" id="tells">
             <div class="alert alert-danger">
          @error('phone')
             <div class="alert alert-danger">{{ $message }}</div>
          @enderror
         </div>
            
            <label for="name">{{ __('メールアドレス') }}</label>
            <input type="text" class="form-control" name="email" id="email">
             <div class="alert alert-danger">
          @error('email')
             <div class="alert alert-danger">{{ $message }}</div>
          @enderror
         </div>
            
            
            
        <div class="d-flex justify-content-between pt-3">
            <a href="{{ asset('/yubins') }}" class="btn btn-outline-secondary" role="button">
                <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
            </a>
            
            
            <button type="submit" class="btn btn-success">
                {{ __('登録') }}
            </button>
        </div>
    </fieldset>
  </form>
</div>
@endsection