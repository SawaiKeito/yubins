@extends('layout')
@section('content')
<h1>該当するお客様</h1>
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
</tr>
@endforeach
</tbody>
</table>
@endsection