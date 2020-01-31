@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-8 offset-2 form-group">
                <div class="row mb-3">
                    <label for="caption">Post Caption</label>
                    <input type="text" name="caption" id="caption" class="form-control" value="{{ old('caption') }}"> 
                    
                    @error('caption')
                       <div class="text-danger"> {{ $message }} </div>
                    @enderror()
                </div>
 
                <div class="row mb-3">
                    <label for="image">Post Image</label>
                    <input type="file" name="image" id="image" class="form-control" value="{{ old('image') }}">

                    @error('image')
                        <div class="text-danger"> {{ $message }} </div>
                    @enderror()
                </div>            

                <div class="row pt-4">
                    <button class="btn btn-primary d-block m-auto" type="submit">Upload Post</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
