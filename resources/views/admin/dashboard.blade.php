@extends('layouts.admin')
@section('custom-css')
<style>
    h2.active{
        margin-top:10px;
    }
</style>
@endsection
@section('content')
<div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Statistics of website visitors</h4>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>Account Active</th>
                                        <th>Account accessed last month</th>
                                        <th>Account access this month</th>
                                        <th>Total accounts visited</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                            <div class="badge badge-opacity-success">{{$visitors_count}}</div>
                                            <p>people</p>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="badge badge-opacity-success">{{$visitor_last_month_count}}</div>
                                            <p>people</p>  
                                        </td>
                                        <td>
                                        <div class="badge badge-opacity-success">{{$visitor_this_month_count}}</div>
                                            <p>people</p>  
                                        </td>
                                        <td>
                                            <div class="badge badge-opacity-success">{{$all_visitors_count}}</div>
                                            <p>people</p>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
@endsection