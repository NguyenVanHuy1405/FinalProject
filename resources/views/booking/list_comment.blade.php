@foreach('$comments as $comm')
<div class="media">
    <a class="pull-left mr-2" href="#">
        <img class="media-object" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1nYUKHA8kkUlIr9DG9woo_y0QtY9m9SGylQ&usqp=CAU" alt="image" width="60">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{$comm->cus->name}}</h4>
        <p>{{$comm->content}}</p>
        <p>
            @if(Auth::check())
            <a href="" class="btn btn-sm btn-primary">Reply comment</a>
            @else
            <button type="button" class="btn btn-danger login-modal" data-toggle="modal" data-target="#exampleModal">
                Login to comment
            </button>
            @endif
        </p>
        <form action="" method="POST" style="display:none">
            <div class="form-group">
                <textarea id="comment-content" class="form-control" placeholder="Enter your comment(*)"></textarea>
                <div id="comment-error" class="error"></div>
            </div>
            <button type="button" class="btn btn-primary" id="btn-comment">Send Comment</button>
        </form>
        <hr>


        {{-- reply comment --}}
        @foreach($comments->replies as $child)
        <div class="media">
            <a class="pull-left mr-2" href="#">
                <img class="media-object" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS1nYUKHA8kkUlIr9DG9woo_y0QtY9m9SGylQ&usqp=CAU" alt="image" width="60">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$child->replies->name}}</h4>
                <p>{{$child->content}}</p>
                <p>
                    @if(Auth::check())
                    <a href="" class="btn btn-sm btn-primary">Reply comment</a>
                    @else
                    <button type="button" class="btn btn-danger login-modal" data-toggle="modal" data-target="#exampleModal">
                        Login to comment
                    </button>
                    @endif
                </p>
                <form action="" method="POST" style="display:none">
                    <div class="form-group">
                        <textarea id="comment-content" class="form-control" placeholder="Enter your comment(*)"></textarea>
                        <div id="comment-error" class="error"></div>
                    </div>
                    <button type="button" class="btn btn-primary" id="btn-comment">Send Comment</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach
