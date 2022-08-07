@extends('master')

@section('content')


    <div class="container-lg">

        <div class="row mt-5 w-100 justify-content-center">
            <h1 class="text-center mb-5 text-black">Todolist Form</h1>
            <div class="col-4  text-dark me-3 ">
                <div class="p-3 bg-dark card">
                    <form action="{{route('post#create')}}" method="post">
                        @csrf
                        <div class="text-group mb-3">
                            <label for="" class="text-light">Post Title</label>
                            <input type="text" name="postTitle" id="" class="form-control" placeholder="Enter Post Tilte..." required>
                        </div>
                        <div class="text-group mb-3">
                            <label for="" class="text-light">Post Description</label>
                            <textarea name="postDescription" id="" cols="30" rows="10" placeholder="Enter Post Description..." class="form-control" required></textarea>
                        </div>
                        <div>
                            <input type="submit" value="Create" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6">


                <div class="data-container">
                    @foreach ($posts as $item)
                    <div class="post p-3 shadow-sm bg-dark mb-3 card ">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <h5 class="text-light">{{$item['title']}}</h5>
                            <h6 class="text-success">{{$item['created_at']}}</h6>
                        </div>
                        <p class="">
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


            </div>

        </div>
    </div>

@endsection
