@extends('master')

@section('content')

    <div class="container-lg">


        <div class="row mt-5 w-100 justify-content-center">
            <h1 class="text-center mb-5 text-black"><u>Todolist Form</u></h1>
            <div class="col-4 text-dark me-3 ">
                <div class="p-3 bg-dark card shadow-sm">
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    @if (session('insertSuccess'))
                    <div class="alert-message">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{session('insertSuccess')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif
                    @if (session('updateSuccess'))
                    <div class="alert-message">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{session('updateSuccess')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    </div>
                    @endif

                    <form action="{{route('post#create')}}" method="post">
                        @csrf

                        <div class="has-validation  mb-3">
                            <label for="" class="text-light form-label " for="validationServer03">Post Title</label>
                            <input type="text" name="postTitle" id="validationServer03" aria-describedby="validationServer03Feedback" value="{{old('postTitle')}}" class="form-control @error('postTitle') is-invalid @enderror" placeholder="Enter Post Tilte..." >

                            @error('postTitle')
                            <div class="invalid-feedback" id="validationServer03Feedback">
                                {{$message}}
                            </div>
                            @enderror

                        </div>


                            <div class="has-validation form-group my-5">
                                <label for="" class="input-group text-light form-label">Post Description</label>
                                <textarea name="postDescription" id="" value=""  cols="30" rows="10" placeholder="Enter Post Description..." class=" form-control @error('postDescription') is-invalid @enderror">{{old('postDescription')}}</textarea>

                                @error('postDescription')
                                <div class="invalid-feedback d-block">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                        <div class="">
                            <button type="submit" class="btn btn-danger">Create</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6">

                <h3 class="mb-3 text-end">Total Posts {{$posts->total()}}</h3>
                <div class="data-container">
                    @foreach ($posts as $item)
                    <div class="post p-3 shadow-sm bg-dark mb-3 card ">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <h5 class="text-light">{{$item['title']}}</h5>
                            <h6 class="text-success">{{$item['created_at']}}</h6>
                        </div>
                        <p>
                            {{Str::words($item['description'],30,'...')}}
                        </p>
                        <div class="text-end">
                            {{-- <a href="{{url('post/delete/'.$item['id'])}}">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </a> --}}
                            <form action="{{route('post#deletePage',$item['id'])}}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                            <a href="{{route('post#updatePage',$item['id'])}}">

                                <button class="btn btn-sm btn-primary"><i class="fa fa-file-lines"></i> See more</button>
                            </a>
                        </div>
                    </div>
                    @endforeach

                    {{-- @for ($i=0; $i<count($posts); $i++)

                    <div class="post p-3 shadow-sm bg-dark mb-3 card ">
                        <h5 class="text-light">{{$posts[$i]['title']}}</h5>
                        <p class="">
                            {{$posts[$i]['description']}}
                        </p>
                        <div class="text-end">
                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            <button class="btn btn-sm btn-primary"><i class="fa fa-file-lines"></i></button>
                        </div>
                    </div>

                    @endfor --}}


                </div>
            {{$posts->links()}}

            </div>

        </div>
    </div>

@endsection
