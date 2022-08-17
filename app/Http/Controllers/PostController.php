<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\createPostRequest;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function create(){
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        // dd($posts);
        return view('create',compact('posts'));
    }
    //post create
    public function postCreate(Request $request){
        // dd($request->all());
        $this->validationCheck($request,'create');
        $data = $this->getPostData($request);
        Post::create($data);
        return back()->with(['insertSuccess'=>'Created Success']);
    }
    //delete post
    public function postDelete($id){
        // first way
        // Post::where('id',$id)->delete();
        // second way
        $post = Post::find($id);
        $post->delete();
        return back();
    }
    //See detail Page
    public function updatePage($id){
        $post = Post::where('id',$id)->first()->toArray();
        return view('update',compact('post'));
    }

    //editPage
    public function postEdit($id){
        $post = Post::where('id',$id)->first()->toArray();
        return view('edit',compact('post'));
    }
    //update data
    public function update(Request $request)
    {
        $this->validationCheck($request,'update');
        $updateData = $this->getPostData($request);
        $id = $request->postId;
        $post = Post::where('id',$id)->update($updateData);
        return redirect()->route('post#createPage')->with(['updateSuccess'=>'Updated Success']);
    }
    private function getPostData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
        ];
    }
    //post validation check
    private function validationCheck($request,$status){
        // dd($status);
        if($status==="create"){
            $validationRules = [
                'postTitle'=> 'required|unique:posts,title',
                'postDescription'=> 'required',
            ];
        }else{
            $validationRules = [
                'postTitle'=> 'required|unique:posts,title,'.$request->postId,
                'postDescription'=> 'required',
            ];
        }

        $validationMessages = [
            'postTitle.required'=> 'Post title is a must!!',
            'postDescription.required'=> 'Post description is a must!!',
            'postTitle.unique'=> 'Pay htrr pee thrr pr!!',
            'postTitle.min'=> 'A nl sone sr lone 10 lone lo add pr tl bya',
            'postTitle.max'=> 'A myr sone sr lone 20 pl ya pr tl bya',

        ];
        Validator::make($request->all(),$validationRules,$validationMessages)->validate();
    }
}
