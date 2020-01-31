@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/post/{{$post->id}}/comment/{{$comment->id}}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2 form-group">
                <label for="comment">Edit Your Comment</label>
                <textarea name="comment" id="comment" class="form-control" cols="30" rows="5" autofocus>{{ $comment->comment }}</textarea>
                <div class="row pt-4">
                    <button class="btn btn-primary d-block m-auto" type="submit">Post Comment</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
