@extends('layouts.app')

@section('content')
{{-- <script src="{{ asset('js/likes/like.js') }}"></script> --}}

<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{$post->image}}" alt="{{$post->caption}}" class="w-100">
        </div>

        <div class="col-3">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $post->user->profile->profileImage() }}" alt="User Profile" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    <div>
                        <div class="font-weight-bold"> 
                            <a href="/profile/{{ $post->user->id }}-{{Str::slug($post->user->username)}}">
                                <span class="text-dark"> {{ $post->user->username }}</span>
                            </a>
                            <a href="#" class="pl-3">Follow</a>
                        </div>
                    </div>    
                </div>
                <hr>
            </div>
            <p> 
                <span class="font-weight-bold"> 
                    <a href="/profile/{{ $post->user->id }}-{{Str::slug($post->user->username)}}"> 
                        <span class="text-dark">{{ $post->user->username }}</span>
                    </a>
                </span> 
                <span class="text-dark">{{ $post->caption }}</span>
            </p>

            <div class="likeAndComment">
                <div class="mb-3 d-flex">
                    <div>
                        @if($like !== null && auth()->user()->id == $like->user_id)
                            <button class="btn btn-link"  id="likeBtn" style="color: red;" onclick=" isLike({{ $post->id }});//event.preventDefault(); getElementById('like-form').submit(); " >
                                <i id="like" class="fa fa-heart mr-5 mt-1" style="font-size:2.5em; "></i>
                            </button>
                        @else
                            <button class="btn btn-link"  id="likeBtn" style="color: gray;" onclick=" isLike({{ $post->id }});//event.preventDefault(); getElementById('like-form').submit(); " >
                                <i id="like" class="fa fa-heart mr-5 mt-1" style="font-size:2.5em; "></i>
                            </button>
                        @endif
                          
                        <div class="d-flex">    
                            <p> 
                            <strong id="likesCounter"> {{ $countLikes. ' Likes' }}</strong>
                            </p>
                        </div>
                    </div>
                   
                    {{-- Comment --}}
                    <div class="mt-2">
                        <a href=" {{ route('comments.create', $post->id) }}" class="btn btn-primary mb-2 btn-sm fa fa-comment" style="font-size:1.2em;"></a>
                        <div class="d-flex">
                            <p class="mt-1"> 
                                <strong> {{ $post->comments->count() > 0 ? $post->comments->count().' Comments' : '0 Comments'}} </strong>
                            </p>
                        </div>
                    </div>
                </div>

                <div>
                    @foreach ($post->comments as $comment)
                        <div >

                            <div class="pd-3 d-flex align-items-center">
                                <img src="{{ $comment->user->profile->profileImage() }}" alt="User Profile" class="rounded-circle w-100" style="max-width: 40px;">
                                <p class="ml-2"><a href="/profile/{{ $comment->user->id }}-{{Str::slug($comment->user->username)}}" class="text-dark"> {{ $comment->user->username }} </a></p>
                            </div>
                            
                            <p>{{ $comment->comment }}</p>
                                    
                            <div>
                                @if (auth()->user() && auth()->user()->id === $comment->user_id)
                                    <div class="d-flex mb-4 ">
                                        <a href="/post/{{ $post->id }}/comment/{{ $comment->id }}/edit" class="btn btn-sm btn-outline-primary mr-3">Edit</a>
                                        <form action="/post/{{ $post->id }}/comment/{{ $comment->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>              
                                @endif
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ##############################################################
                      Ajax Call Start
     ############################################################## --}}

<script>
    $(document).ready(function(){
        $('#likeBtn').click(function() {
            isLike(postId);
            countLikes(postId);
        });
    });

    function isLike(postId)
    {
        $.ajax (
        {
            url: "/post/" + postId + "/like",
            type: "POST",
            data: { data: postId, _token: "{{csrf_token()}}" },
            dataType: "json",
            success: function(response) 
            {
                if(response.isLiked  === true)  
                {
                    $('#like').css("color", "red");
                    countLikes(postId);
                    
                } else 
                {
                    $('#like').css("color", "gray");
                    countLikes(postId);
                }
            }, 
            error: function(e) 
            {
                console.log(e.responseText);
            }
        });
    }

    //Function to count likes asynchronously
    function countLikes(postId)
    {
        $.ajax ( 
        {
            url: '/post/' + postId + '/like/count',
            type: 'post',
            data: { postId: postId, _token: '{{csrf_token()}}'},
            dataType: 'json',
            success: function(response) 
            {
                $('#likesCounter').html(response + ' Likes');
            }, 
            error: function(e) 
            {
                console.log(e.responseText);
            }
        });
    }


</script>

{{-- ##############################################################
                      Ajax Call End
    ############################################################## --}}

@endsection
