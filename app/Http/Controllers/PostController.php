<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function create(){
        $posts = Post::orderBy('created_at','desc')->get()->toArray();

        return view('create',compact('posts'));
    }
    //post create
    public function postCreate(Request $request){
        $data = $this->getPostData($request);
        Post::create($data);
        return back();
        // return redirect()->route('testing');
    }

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
        $updateData = $this->getPostData($request);
        $id = $request->postId;
        $post = Post::where('id',$id)->update($updateData);
        return redirect()->route('post#createPage');
    }
    private function getPostData($request){
        return [
            'title' => $request->postTitle,
            'description' => $request->postDescription,
        ];
    }



}
