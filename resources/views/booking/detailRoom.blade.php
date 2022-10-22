@extends('layouts.main')
@section('custom-css')
<style>
    img.img-fluid {
        height: 350px;
        width: 600px;
    }
    img.img-body {
        height: 350px;
        width: 360px;
    }
    div.room_tag {
        font-size: 14px;
    }
    p.excert {
        font-size: 16px;
    }
    img.image_recomend {
        width: 125px;
        height: 75px;
    }
    a.booking {
        font-size: 12px;
    }
    li.a.tag {
        font-size: 16px;
    }
    div.fb-share-button{
        padding-bottom:10px;
    }
    div.fb-like{
        padding-bottom:10px;
    }
    div.comment{
        margin-left:-8px;
        margin-top:20px;
        font-weight: bold;
        font-size: 20px;
    }
    h4.media-heading{
        margin-top:10px;
    }
    p.text{
        font-size: 14px;
        font-weight: normal;
    }
    button.login-modal{
        margin-top:-20px;
    }
    div.error{
        color:red;
        font-size: 14px;
        margin-bottom:-10px;
    }
</style>
@endsection
@section('title','Detail room')
@section('content')
<section class="breadcrumb_area">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
    <div class="container">
        <div class="page-cover text-center">
            <h2 class="page-cover-tittle">DETAILS ROOM</h2>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/bookingRoom')}}">Back to booking room</a></li>
            </ol>
        </div>
    </div>
</section>
<section class="blog_area single-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post row">
                    @foreach($room as $key => $value)
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <img class="img-fluid" src="{{URL::to('admin/uploads/room/'.$value->room_image)}}" alt="">
                        </div>
                    </div>
                    @endforeach
                    <div class="col-lg-3  col-md-3">
                        <div class="blog_info text-right">
                            @foreach($room_id as $key => $kind)
                            <div class="post_tag">
                                <div class="room_tag"><b>Room Type:</b> {{$kind->roomtype_name}}</div>
                            </div>
                            <div class="post_tag">
                                <div class="room_tag"><b>Kind of room:</b> {{$kind->kindofroom_name}}</div>
                            </div>
                            @endforeach
                            @foreach($room as $key => $value)
                            <form action="{{URL::to('/save-cart')}}" method="post">
                                {{csrf_field()}}
                                <div class="post_tag">
                                    <div class="room_tag" name="room_price"><b>Room Price: </b>{{number_format($value->room_price).' '.'VND/'}}night</div>
                                </div>
                                <div class="form-group post_tag">
                                    <label><b>Arrival Date:</b></label> <br>
                                    <input type="date" class="form-control @error('departureDate') is-invalid @enderror" name="arrivalDate">
                                    @if ($errors->has('arrivalDate'))
                                    <span>
                                        @error('arrivalDate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group post_tag">
                                    <label><b>Departure Date:</b></label> <br>
                                    <input type="date" class="form-control @error('departureDate') is-invalid @enderror " name="departureDate">
                                    @if ($errors->has('departureDate'))
                                    <span>
                                        @error('departureDate')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </span>
                                    @endif
                                </div>
                                <input name="roomId_hidden" type="hidden" value="{{$value->id}}">
                                <div class="post_tag">
                                    <button type="submit" class="btn theme_btn button_hover">Book Room Now</button>
                                </div>
                            </form>
                            @endforeach
                            <ul class="blog_meta list_style">
                                <li><a href="#">1.2M Views<i class="lnr lnr-eye"></i></a></li>
                                <li><a href="#">06 Comments<i class="lnr lnr-bubble"></i></a></li>
                                <div class="fb-share-button" data-href="http://127.0.0.1:8000/detailRoom/5" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                                <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="standard" data-action="like" data-size="large" data-share="false"></div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 blog_details">
                        @foreach($room as $key => $description)
                        <h2><b>Room name: </b>{{$description->room_name}}</h2>
                        <p class="excert">
                            <b>Description room: </b>{{$description->room_description}}
                        </p>
                        <p class="excert">
                            <b>Room content: </b>{{$description->room_content}}
                        </p>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-6">
                                <img class="img-body" src="{{URL::to('admin/uploads/room/'.$value->room_image)}}" alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-body" src="{{URL::to('admin/uploads/room/'.$value->room_image)}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">RECOMMENDED ROOMS</h3>
                        @foreach($related->roomtype->rooms as $related)
                        <div class="media post_item">
                            <img class="image_recomend" src="{{URL::to('admin/uploads/room/'.$related->room_image)}}" alt="post">
                            <div class="media-body">
                                <h3 class="room_name"><b>Room name:</b>{{$related->room_name}}</h3>
                                <p class="text_room"><b>Room price:</b>{{number_format($related->room_price)}} VNĐ</p>
                                <a href="{{URL::to('/detailRoom/'.$related->id)}}" class="btn btn-primary booking">Book Room Now</a>
                            </div>
                        </div>
                        @endforeach
                        <div class="br"></div>
                    </aside>
                    <aside class="single-sidebar-widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Rooms</h4>
                        <ul class="list_style">
                            @foreach($room_id as $key => $tag)
                            <li><a class="tag" href="{{URL::to('/show-roomtype/'.$tag->roomtype_id)}}">{{$tag->roomtype_name}}</a></li>
                            <li><a class="tag" href="{{URL::to('/show-kindofroom/'.$tag->kindofroom_id)}}">{{$tag->kindofroom_name}}</a></li>
                            @endforeach
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
<div class="container">
    <h4>Comment Room</h4>
    @if(Auth::check())
        <form action="" method="POST" role="form">
            <legend>Hello: {{(Auth::user()->name)}}</legend>
            <div class="form-group">
                <label for="">Content Comment</label>  
                <textarea id="comment-content" class="form-control" placeholder="Enter your comment(*)"></textarea>
                <div id="comment-error" class="error"></div> 
            </div>
            <button type="button" class="btn btn-primary" id="btn-comment">Send Comment</button>
        </form>
        @else
        <button type="button" class="btn btn-danger login-modal" data-toggle="modal" data-target="#exampleModal">
            Login to comment
        </button>
        <hr>
        @endif
        <br>
        <h3>Comments</h3>
        <div id="comment">
        </div>
</div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" role="form">
        <div id="error"></div>
        <div class="form-group">
           <label for="">Email:</label>
           <input type="text" class="form-control" id="email" placeholder="Enter your email">
        </div>   
        <div class="form-group">
           <label for="">Password:</label>
           <input type="password" class="form-control" id="password" placeholder="Enter your password">
        </div>    
        
        <button type="button" class="btn btn-primary btn-block" id="btn-login">Login</button>

      </form> 
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom-js')
<script>
    var _csrf = '{{csrf_token()}}';
    $('#btn-login').click(function(ev){
        ev.preventDefault();
        var _loginUrl = '{{route("ajax.login")}}';
        var email = $('#email').val();
        var password= $('#password').val();

        $.ajax({
            url:_loginUrl,
            type: 'POST',
            data:{
                email:email,
                password:password,
                _token : _csrf,
            },
            success:function(res){
                if(res.error){
                    let _html_error = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>';
                    for(let error of res.error){
                        _html_error +=`<li>${error}</li>`; 
                    }
                    _html_error += '</div>';
                    $('#error').html(_html_error);
                }else{
                    alert('Login Successfully');
                    location.reload();
                }
            }
        });
    });

    $('#btn-comment').click(function(ev){
        ev.preventDefault();
        let content = $('#comment-content').val();
        let _commentUrl = '{{route("ajax.comment", $value->id)}}';
        $.ajax({
            url: _commentUrl,
            type: 'POST',
            data: {
                content: content,
                _token : _csrf
            },
            success: function(res) {
                if (res.error) {
                    $('#comment-error').html(res.error)
                } else {
                    $('#comment-error').html('');
                    $('#comment-content').val('');
                }
            }
        });
    })
</script>
@endsection
