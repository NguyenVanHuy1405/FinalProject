@foreach($comments as $comm)
<div class="media">
    <li class="nav-item submenu dropdown">
        <button class="btn" type="button">
            <a class="nav-link" href="{{ route('user.profile') }}" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <img class="img-account-profile mb-2" src="{{ $comm->cus->avatar == null? asset('/home/image/avatar.png'): asset('/storage/image/' . $comm->cus->avatar) }}" alt="{{ asset('public/home/image/avatar.png')}}" style="height: 80px; margin-top: -30px; object-fit: cover;" loading="lazy">
            </a>
        </button>
    </li>
    <div class="media-body">
        <h4 class="media-heading">{{$comm->cus->name}}</h4>
        <p>{{$comm->content}}</p>
        <p>
            @if(Auth::check())
            <a href="" class="btn btn-sm btn-primary btn-show-reply-form" data-id={{$comm->id}}>Reply comment</a>
            @else
            <button type="button" class="btn btn-danger login-modal" data-toggle="modal" data-target="#exampleModal">
                Login to reply comment
            </button>
            @endif
        </p>
        <form action="" method="POST" style="display:none" class="formReply form-reply-{{$comm->id}}">
            <div class="form-group">
                <textarea id="comment-reply-{{$comm->id}}" class="form-control" placeholder="Enter your comment(*)"></textarea>
                <div id="comment-error" class="error"></div>
            </div>
            <button type="submit" data-id={{$comm->id}} class="btn btn-primary btn-send-comment-reply" id="btn-comment">Send Comment</button>
        </form>
        <hr>
        {{-- reply comment --}}
        @foreach($comm->replies as $child)
        <div class="media">
            <a class="pull-left mr-2" href="#">
                <li class="nav-item submenu dropdown">
                    <button class="btn" type="button">
                        <a class="nav-link" href="{{ route('user.profile') }}" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <img class="img-account-profile mb-2" src="{{ $child->cus->avatar == null? asset('/home/image/avatar.png'): asset('/storage/image/' . $child->cus->avatar) }}" alt="{{ asset('public/home/image/avatar.png')}}" style="height: 80px; margin-top: -30px; object-fit: cover;" loading="lazy">
                        </a>
                    </button>
                </li>
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$child->cus->name}}</h4>
                <p>{{$child->content}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach
