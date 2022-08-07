@extends('master')
@section('content')
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-4 offset-4 bg-dark text-light p-3 card">
            <a href="{{route('post#updatePage',$post['id'])}}">
            <div class="text-muted mb-3">
                <i class="fa fa-arrow-left"></i>
                <span>back</span>
            </div>
            </a>
            <form action="{{route('post#update')}}" method="post">
                @csrf
                <label for="">Post Title</label>
                <input name="postTitle" type="text" class="form-control" value="{{$post['title']}}">
                <input type="hidden" name='postId' value="{{$post['id']}}">
                <label for="">Post Description</label>
                <textarea name="postDescription" id="" cols="30" rows="10" class="form-control" >{{$post['description']}}</textarea>
                <input type="submit" value="Update" class="btn btn-light mt-3 input-group">
            </form>
        </div>
    </div>
</div>
@endsection


