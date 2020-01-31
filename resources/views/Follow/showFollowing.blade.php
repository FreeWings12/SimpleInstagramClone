@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if($following->count() > 0)
                <h4 class="mb-4 text-success">Your are following</h4>
                @foreach($following as $following)
                    <div class="col-md-12 mb-4 d-flex align-items-center">
                        <div class="pr-3"> 
                            <img src="{{$following->profileImage()}}"  class="rounded-circle w-100" style="max-width: 40px;"> 
                        </div>
                        <div class="font-weight-bold">  
                            <a href="/profile/{{ $following->user_id }}-{{ Str::slug($following->title) }}">
                                <span class="text-dark"> {{ $following->title}} </span>
                            </a>
                        </div>

                        {{-- <div>
                            @if(auth()->user()->id !== $following->user_id)
                                <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}">  </follow-button>
                            @endif
                        </div> --}}
                    </div>      
                @endforeach
            @else
                <div class="col-md-12 align-items-center mt-5">
                    <h3 class="text-danger text-center"> Not Following Anyone Yet!! </h3>
                </div>
            @endif
        </div>
    </div>
@endsection
