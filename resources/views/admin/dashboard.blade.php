@extends('layouts.admin')
@section('custom-css')
<style>
    h2.active {
        margin-top: 10px;
    }

    p.title_staticstics {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }

    p.title {
        text-align: left;
        font-size: 16px;
    }

    div.container_date {
        margin: auto;
        margin-left:10px;
    }

    div.from_day {
        float: left;
        width: 150px;
    }

    div.to_day {
        float: left;
        width: 150px;
        margin-left: 10px;
    }
</style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection
@section('content')
<div class="row">
    <p class="title_staticstics"> Order sales statistics</p>
    <form autocomplete="off">
        @csrf
        <div class="container_date">
            <div class="col-md-2 from_day">
                <p class="title">From day: <input type="text" id="datepicker" class="form-control" /></p>
                <input type="button" id="btn-dashboard-filter" class="btn btn-success" value="Filter results"></p>
            </div>
            <div class="col-md-2 to_day">
                <p class="title">To day: <input type="text" id="datepicker1" class="form-control" /></p>
            </div>
        </div>
    </form>
    <div class="col-md-12">
        <div id="myfisrtchart" style="height:350px;"></div>
    </div>
</div>
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
                                <th>Account access last year</th>
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
                    <div class="badge badge-opacity-success">{{$visitor_last_year_count}}</div>
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
@section('custom-js')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  } );
  </script>
  <script>
  $( function() {
    $( "#datepicker1" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  </script>
  <script type="text/javascript">
      $(document).ready(function() {
          $('#btn-dashboard-filter').click(function() {
              var _token = $('input[name="_token"]').val();
              var from_date = $('#datepicker').val();
              var to_date = $('#datepicker1').val();
              $.ajax({
                url: "{{url('/filter-by-day')}}",
                method:"POST",
                dataType:"JSON",
                data:{from_date:from_date,to_date:to_date,_token:_token},

                success: function(data){
                }
              });
          });
      });
  </script>

@endsection

