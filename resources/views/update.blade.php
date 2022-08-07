@extends('master')
@section('content')
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-4 offset-4 bg-dark text-light p-3 card">
                <a href="{{route('post#createPage')}}" >
                <div class="text-muted mb-3">
                    <i class="fa fa-arrow-left"></i>
                    <span>back</span>
                </div>
                </a>

                <h3>{{$post['title']}}</h3>
                <p class="text-muted">{{$post['description']}}</p>
                <a href="{{route('post#editPage',$post['id'])}}" >
                    <button class="btn btn-light input-group">Edit</button>
                </a>
            </div>
        </div>
    </div>
@endsection
