@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
        <img alt="freecodecamp's profile picture" class="rounded-circle w-100" src="{{ $user->profile->profileImage() }}">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->username }}</div>
                    
                    @if(auth()->user()->id !== $user->id)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"> </follow-button>
                    @endif

                </div>
                @can('update', $user->profile)
                    <a href="/post/create" class="btn btn-primary">Add New Post</a>                    
                @endcan

            </div>
            @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>                
            @endcan

            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postsCount }}</strong> Posts</div>
                <div class="pr-5"> <a href="{{ route('showFollowers', $user->id) }}" class="text-dark"> <strong> {{ $followersCount }} </strong>  Followers </a></div>
                <div class="pr-5"> <a href="{{ route('showFollowing', $user->id) }}" class="text-dark"> <strong> {{ $followingCount }} </strong> Following </a></div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
        <div class="row pt-5">
            
            @foreach ($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href="/post/{{$post->id}}">
                        <img alt="{{ $post->caption }}" class="w-100 h-170" src="/storage/{{ $post->image }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
