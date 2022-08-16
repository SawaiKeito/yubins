@extends('layout')

@section('content')
<div class="container small">
  <h1>編集</h1>
  <form action="{{ route('yubins.update',['id'=>$yubins->id])}}" method="POST">
  @csrf
    <fieldset>
      <div class="form-group">
        
        <label for="name">{{ __('名前') }}</label>
        <input type="text" class="form-control" name="name" id="name"  value="{{ old('name', $yubins->name) }}">
        <div class="alert alert-danger">
          @error('name')
             <div class="alert alert-danger">{{ $message }}</div>
          @enderror
         </div>
         <label for="name">{{ __('郵便番号') }}</label>
        <input type="text" class="form-control" name="post7" id="post7"  value="{{ old('post7', $yubins->post7) }}">
          @error('post7')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror
         
        
         <label for="name">{{ __('住所') }}</label>
        <input type="text" class="form-control" name="address" id="address"  value="{{ old('address', $yubins->address) }}">
         @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror
         
         
         <label for="name">{{ __('自宅電話') }}</label>
        <input type="text" class="form-control" name="tell" id="tell"  value="{{ old('tell', $yubins->tell) }}">
         @error('tell')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror
        
        
         <label for="name">{{ __('携帯電話') }}</label>
        <input type="text" class="form-control" name="phone" id="phone"  value="{{ old('phone', $yubins->phone) }}">
         @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror
         
         
         <label for="name">{{ __('メールアドレス') }}</label>
        <input type="text" class="form-control" name="email" id="email"  value="{{ old('email', $yubins->email) }}">
         @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror
         
         
      </div>
      
       <div class="d-flex justify-content-between pt-3">
            <a href="{{ asset('/yubins') }}" class="btn btn-outline-secondary" role="button">
                <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('一覧画面へ') }}
            </a>
            
        <button type="submit" class="btn btn-success">
            {{ __('更新') }}
        </button>
      </div>
      
    </fieldset>
  </form>
</div>
@endsection