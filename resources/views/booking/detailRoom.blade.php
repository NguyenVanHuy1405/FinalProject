@extends('layouts.main')
@section('custom-css')
<style>
    img.img-fluid {
        height: 350px;
        width: 700px;
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
                <li><a href="{{URL::to('/bookingroom')}}">Back to booking room</a></li>
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
                            @foreach($room as $key => $kind)
                            <div class="post_tag">
                                <div class="room_tag"><b>Room Type:</b> {{$kind->roomtype_name}}</div>
                            </div>
                            <div class="post_tag">
                                <div class="room_tag"><b>Kind of room:</b> {{$kind->kindofroom_name}}</div>
                            </div>
                            <form action="{{URL::to('/save-cart')}}" method="post">
                                {{csrf_field()}}
                                <div class="post_tag">
                                    <div class="room_tag" name="room_price"><b>Room Price: </b>{{number_format($kind->room_price).' '.'VND/'}}night</div>
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
                                <input name="roomid_hidden" type="hidden" value="{{$kind->room_id}}">
                                <div class="post_tag">
                                    <button type="submit" class="btn theme_btn button_hover">Book Room Now</button>
                                </div>
                            </form>
                            @endforeach
                            <ul class="blog_meta list_style">
                                <li><a href="#">1.2M Views<i class="lnr lnr-eye"></i></a></li>
                                <li><a href="#">06 Comments<i class="lnr lnr-bubble"></i></a></li>
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
                <div class="comments-area">
                    <h4>05 Comments</h4>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="image/blog/c1.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Emilly Blunt</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="image/blog/c2.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Elsie Cunningham</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="image/blog/c3.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Annie Stephens</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="image/blog/c4.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Maria Luna</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="image/blog/c5.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Ina Hayes</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-form">
                    <h4>Leave a Reply</h4>
                    <form>
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Name'">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 email">
                                <input type="email" class="form-control" id="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Subject'">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control mb-10" rows="5" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                        </div>
                        <a href="#" class="primary-btn button_hover">Post Comment</a>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">RECOMMENDED ROOMS</h3>
                        @foreach($related_room as $key => $related)
                        <div class="media post_item">
                            <img class="image_recomend" src="{{URL::to('admin/uploads/room/'.$related->room_image)}}" alt="post">
                            <div class="media-body">
                                <h3 class="room_name"><b>Room name:</b>{{$related->room_name}}</h3>
                                <p class="text_room"><b>Room price:</b>{{number_format($related->room_price)}} VNĐ</p>
                                <a href="#" class="btn btn-primary booking">Book Room Now</a>
                            </div>
                        </div>
                        @endforeach
                        <div class="br"></div>
                    </aside>
                    <aside class="single-sidebar-widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Rooms</h4>
                        <ul class="list_style">
                            @foreach($room as $key => $tag)
                            <li><a class="tag" href="{{URL::to('/show-roomtype/'.$tag->roomtype_id)}}">{{$tag->roomtype_name}}</a></li>
                            <li><a class="tag" href="{{URL::to('/show-roomtype/'.$tag->kindofroom_id)}}">{{$tag->kindofroom_name}}</a></li>
                            @endforeach
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection