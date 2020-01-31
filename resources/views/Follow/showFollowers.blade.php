@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if($followers->count() > 0)
                <h4 class="mb-4 text-success">Your followers</h4>
                @foreach($followers as $follower)
                    <div class="col-md-12 mb-4 d-flex align-items-center">
                        <div class="pr-3"> 
                            <img src="{{$follower->profileImage()}}"  class="rounded-circle w-100" style="max-width: 40px;"> 
                        </div>
                        <div class="font-weight-bold">  
                            <a href="/profile/{{ $follower->user_id }}-{{ Str::slug($follower->title) }}">
                                <span class="text-dark"> {{ $follower->title}} </span>
                            </a>
                        </div>
                        {{-- <div>
                            @if(auth()->user()->id !== $follower->user_id)
                                <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}">  </follow-button>
                            @endif
                        </div> --}}
                    </div>      
                @endforeach
            @else
                <div class="col-md-12 align-items-center mt-5">
                    <h3 class="text-danger text-center"> No Followers Yet!! </h3>
                </div>
            @endif

        </div>
    </div>
@endsection
