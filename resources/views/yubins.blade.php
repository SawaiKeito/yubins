@extends('layout')
@section('content')
    <h1>住所録</h1>
          <form action="yubins" method="POST" class="form-horizontal">
                  {{ csrf_field() }}
            <div class="form-group">
               <label for="yubin" class="col-sm-3 control-label">登録情報検索</label>
               <div class="col-sm-3">
                 <input type="text" name="name" id="name" class="form-control" placeholder="郵便太郎"　>
               </div>
               <div>
                 <input type="text" name="address" id="address" class="form-control" placeholder="東京都新宿区市ヶ谷本村町5−1">
               </div>
            </div>
            <div class="form-group">
             <div class="col-sm-offset-3 col-sm-6">
               <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> 検索</button>
             </div>
            </div> 
            
          </form>
    <table class="table table-striped task-table">
      <thead>
       <th>名前</th> <th>郵便番号</th>  <th>住所</th>  <th>電話番号</th>  <th>携帯電話</th>  <th>メール</th>
      </thead>
     <tbody>
       @foreach ($yubins as $row)
       <tr>
          <td>{{ $row->name }}</td>
          <td>{{ $row->post7 }}</td> 
          <td>{{ $row->address }}</td>
          <td>{{ $row->tell}}</td>
          <td>{{ $row->phone }}</td>
          <td>{{ $row->email }}</td>
          <td><a href="{{ route('yubins.edit', ['id'=>$row->id]) }}" class="btn btn-info">編集</a></td>
          <td>
              
        <form action="{{ route('yubins.destroy', ['id'=>$row->id]) }}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
        </form>
        
          </td>
          </tr> 
          @endforeach
      </tbody>
     </table>
        <div class="d-inline-block">
         <li>
            <a href="{{ asset('/home') }}" class="btn btn-outline-secondary" role="button">
                <i class="fa fa-reply mr-1" aria-hidden="true"></i>{{ __('ログアウト') }}
            </a>
         </li>    
         <li>
             @if (Route::has('register'))
            <a class="nav-link" href="{{ asset('/register') }}">{{ __('ユーザーの登録') }}</a>
            @endif
        </li>    
        <li>
            <a href="{{ route('yubins.create') }}">新規登録</a>
        </li>
      </div>
@endsection