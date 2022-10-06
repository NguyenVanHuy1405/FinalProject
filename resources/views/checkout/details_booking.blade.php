@extends('layouts.main')
@section('custom-css')
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600);

*, *:before, *:after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background: ;
  font-family: 'Open Sans', sans-serif;
}
table {
  background: #012B39;
  border-radius: 0.25em;
  border-collapse: collapse;
  margin: 1em;
  padding-top:2em;
  margin-top:120px;
  margin-left:160px;
  weight:1000px;
  height: 100%;
}
th {
  border-bottom: 1px solid #364043;
  color: #E2B842;
  font-size: 0.85em;
  font-weight: 600;
  padding: 0.5em 1em;
  text-align: left;
}
td {
  color: #fff;
  font-weight: 400;
  padding: 0.65em 1em;
}
.disabled td {
  color: #4F5F64;
}
tbody tr {
  transition: background 0.25s ease;
}
tbody tr:hover {
  background: #014055;
}
</style>
@endsection
@section('content')
<table>
  <thead>
    <tr>
      <th>Stt</th>
      <th>Room Name</th>
      <th>Room Price</th>
      <th>Day At Home</th>
    </tr>
  </thead>
  <tbody>
    @php
    $i =0;
    @endphp
    @foreach($detail_order as $key => $value)
    @php
    $i ++;
    @endphp 
    <tr>
      <td>{{$i}}</td>
      <td>{{$value->room_name}}</td>
      <td>{{$value->room_price}}</td>
      <td>{{$value->room_sales_quantity}}</td>
    </tr>  
    @endforeach    
  </tbody>
</table>
@endsection
