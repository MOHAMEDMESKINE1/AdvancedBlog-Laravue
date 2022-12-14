<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $posts = Post::latest()->with('user')->paginate(1);
        $posts = Post::latest()->with('user')->get();
     
            foreach($posts as $post){
                $post->setAttribute('added_at',$post->created_at->diffForHumans());
                $post->setAttribute('comments_count',$post->comments->count());
            }
           
            return response()->json($posts);
        
      
    }
    // public function chartPosts(){
        
    //     $chart_posts=Post::orderBy('id', 'DESC')->get();

    //     return   response()->json($chart_posts);
    // }
    public function searchPosts($query){
        $posts = Post::where('title','like','%'.$query.'%')->with('user')->get();
        
        foreach($posts as $post){

            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
        }

        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return response()->json([
            "id"=>$post->id,
            "title"=>$post->title,
            "slug"=>$post->slug,
            "body"=>$post->body,
            "added_at"=>$post->created_at->diffForHumans(),
            "comments_count"=>$post->comments->count(),
            "image"=>$post->image,
            "user"=>$post->user,
            "category"=>$post->category,
            "comments"=>$this->commentsFormatted($post->comments),
        ]);
    }

    public function commentsFormatted($comments){
          $new_comments = [];

          foreach($comments as $comment){
            array_push($new_comments, [
                    'id'=>$comment->id,
                    'body'=>$comment->body,
                    'user'=>$comment->user,
                    "added_at"=>$comment->created_at->diffForHumans(),
                ] );
          }

          return $new_comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    public function CategoryPosts($slug){
     
        $category =Category::whereSlug($slug)->firstOrFail();
        
        $posts = Post::whereCategoryId($category->id)->with('user')->get();
        
        foreach($posts as $post){

            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
        }

        return response()->json($posts);
    }
}
