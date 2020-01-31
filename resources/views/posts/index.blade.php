@extends('layouts.app')

@section('content')
<div class="container">

    @if($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="row">
                <div class="col-6 offset-3">
                    {{-- <a href="/profile/{{$post->user->id}}-{{Str::slug($post->user->username)}}"> --}}
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="/storage/{{$post->image}}" alt="{{$post->caption}}" class="w-100">
                    </a>

                </div>
            </div>
            <div class="row  pb-4">
                <div class="col-6 offset-3">
                    <div>
                        <p> 
                            <span class="font-weight-bold"> 
                                <a href="/profile/{{ $post->user->id }}-{{ Str::slug($post->user->username) }}"> 
                                    <span class="text-dark">{{ $post->user->username }}:</span>
                                </a>
                            </span> 
                            <span class="text-dark">{{ $post->caption }}</span>
                        </p>
                    </div>
                </div>
            </div>    
            <hr>
        @endforeach
    @else
            <div class="row mt-5">
                <div class="col-md-12 d-flex justify-content-around">
                    <h3 class="text-success">No Post Yet!!</h3>                    
                </div>

            </div>
    @endif

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
