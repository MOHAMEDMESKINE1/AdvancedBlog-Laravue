<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
        

    }
    public function addPost(Request $request){
        $filename=null;
        // check if image isset
        if($request->hasFile('image')){
            // get image name
            $filename = time().".".$request->image->getClientOriginalExtension();
            //  store image in public folder
            $request->image->move(public_path('assets/img'),$filename);
        }
        $post =Post::create([
            "title"=> $request->title,
            "slug"=> Str::slug($request->title),
            "body"=> $request->body,
            // store image in database
            "image"=> $filename,
            "user_id"=> Auth::id(),
            "category_id"=> $request->category,
            
        ]);
        return response()->json($post);
    }
    public function update(Request $request){
        $post = Post::where('id',$request->id)->first();
        // $filename = $post->image ;
        $filename=null;
       
        if($request->hasFile('image')){
          
            $filename = time().".".$request->image->getClientOriginalExtension();
           
            $request->image->move(public_path('assets/img'),$filename);
        }
        $post->update([
            "title"=> $request->title,
            "slug"=> Str::slug($request->title),
            "body"=> $request->body,
            // store image in database
            "image"=> $filename !='' ? $filename : $post->image,
            "user_id"=> Auth::id(),
            "category_id"=> $request->category,
            
        ]);
        return response()->json($post);
    }
    public function getPosts(){

        $posts = Post::latest()->with('user')->with('category')->get();
     
        foreach($posts as $post){
            $post->setAttribute('added_at',$post->created_at->diffForHumans());
            $post->setAttribute('comments_count',$post->comments->count());
            // $post->setAttribute('category',$post->category);
        }
        return response()->json($posts);
    }
    public function CategoryPosts(){
     
        $categories =Category::all();
         
        return response()->json($categories);
    }
    public function NormaldDelete($id){

            $post = Post::find($id);
            $image_path =public_path("assets/img/".$post->image);

            if(File::exists($image_path)){

                File::delete($image_path);

               
                $post->delete();
                return response()->json(['message'=> 'deleted']);
            }else{
                abort(404);
            }
       
    }
    public function destroy(Request $request){


        $ids = array($request->posts_ids) ;
        
      
       
       
        
        $post = Post::whereIn('id',$ids)->first();
        $post->delete();
        return response()->json(['message'=>'deleted']);
        //  $image_path =public_path("assets/img".$post->image);

        // if(File::exists($image_path)){

        //     File::delete($image_path);

        //     $post->delete();
        //     return response()->json(['message'=> 'deleted']);
        // }else{
        //     abort(404);
        // }
       
    }
}
