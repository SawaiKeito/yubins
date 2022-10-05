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
          <td>
        <form action="{{ route('yubins.edit', ['id'=>$row->id]) }}">
          @csrf
          @method('delete')
          <button type="submit">編集</button>
        </form>
          </td>
          <td>
        <form action="{{ route('yubins.destroy') }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{$row->id}}">
          <button type="submit" class="btn btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
        </form>
          </td>
          </tr> 
          @endforeach
      </tbody>
     </table>
      @method('csvexport()')
      <form action="{{ route('yubins.csvexport') }}" method="post">
          @csrf
          <button type="submit">CSV出力</button>
    　</form>
       <div class="wrap">
           <label for="label1">▼ メニュー</label>
           <input type="checkbox" id="label1" class="switch" />
           　<div class="content">
                              <div class="d-inline-block">
                                <li class="nav-item dropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
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
            </div>                   
       </div> 
       <div class="upload">
    <p>DBに追加したいCSVデータを選択してください。</p>
    <form action="upload" method="post" enctype="multipart/form-data">
      @csrf
      <input type="file" name="csvdata" />
      <button>送信</button>
    </form>
  </div>
  
 
@endsection
