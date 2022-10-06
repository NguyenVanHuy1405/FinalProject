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
  background:url("../home/image/home1.jpg") ;
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
div.panel-header{
  padding-top:100px;
  margin-left:160px;
  font-size: 25px;
  font-style:bold;
  margin-bottom:-80px;
  color:red;
  font-family: 'Open Sans', sans-serif;
}
div.success{
  margin-top:100px;
  margin-left:160px;
  margin-bottom:-50px;
}
</style>
@endsection
@section('content')
<div class="panel-header">
  History booking room
</div>
<div class="success">
@include('layouts.alertProfile')
</div>
<table>
  <thead>
    <tr>
      <th>Stt</th>
      <th>Order_total</th>
      <th>Date Order</th>
      <th>Coupon</th>
      <th>Order_Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @php
    $i =0;
    @endphp
    @foreach($get_order as $key => $value)
    @php
    $i ++;
    @endphp 
    <tr>
      <td>{{$i}}</td>
      <td>{{$value->order_total}}</td>
      <td>{{$value->date_order}}</td>
      <td>{{$value->coupon_booking}}</td>
      <td>{{$value->order_status}}</td>
      <td><a href="{{URL::to('/view-booking/historyBooking/'.$value->id)}}" class="active styling-edit" ui-toggle-class="" >
      <i class="fa fa-eye text-success text-active"> <b>See Detail</b></i></a></td>
    </tr>  
    @endforeach    
  </tbody>
</table>
@endsection
