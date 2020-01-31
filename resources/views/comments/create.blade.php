@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('comments.store', $post->id) }}" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2 form-group">
                <label for="comment">Write Your Comment</label>
                <textarea autofocus name="comment" id="comment" class="form-control" cols="30" rows="5" ></textarea>
                <div class="row pt-4">
                    <button class="btn btn-primary d-block m-auto" type="submit">Post Comment</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
