<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::with('category', 'tag', 'user')->get();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'summery' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'tag' => 'required',
            'image' => 'required',
            'alt' => 'required|max:255',
            'meta_des' => 'required|max:255',
            'meta_key' => 'required|max:255',
            'slug' => 'required|unique:posts',
        ], [
            'category_id.required' => 'The category filed is required',
        ]);

       

        $posts = new Post;

        $posts->title = $request->title;
        $posts->summery = $request->summery;
        $posts->content = $request->content;
        $posts->category_id = $request->category_id;
        $posts->meta_des = $request->meta_des;
        $posts->meta_key = $request->meta_key;
        $posts->slug = Str::of($request->slug)->slug('-');
        $posts->status = $request->status;
        $posts->alt = $request->alt;
        $posts->tag_id = implode(",",$request->tag); 
               
        $posts->user_id = auth()->user()->id;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '-' . 'post-image' . '.' . $extension;
            $file->move('front/images/post', $fileName);
            $posts->image = $fileName;
        }

        $posts->save();

        // Tags attach without save;
        $tags = $request->tag;
        foreach($tags as $tag) {
            $posts->tag()->attach($tag);
        }


        return redirect()->route('post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags_id = Post::where('id', $post->id)->get()->first()->tag_id;
        $tags_id = explode(',', $tags_id);
        $tags = Tag::all();
        $categories = Category::all();
        return view('post.edit', compact('tags', 'categories', 'post', 'tags_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'summery' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'tag' => 'required',
            'image' => 'nullable',
            'alt' => 'required|max:255',
            'meta_des' => 'required|max:255',
            'meta_key' => 'required|max:255',
        ], [
            'category_id.required' => 'The category filed is required',
        ]);

        if($post->slug != $request->slug) {
            $request->validate([
                'slug' => 'required|unique:posts',
            ]);
        }


        $post->title = $request->title;
        $post->summery = $request->summery;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->meta_des = $request->meta_des;
        $post->meta_key = $request->meta_key;
        $post->slug = Str::of($request->slug)->slug('-');
        $post->status = $request->status;
        $post->alt = $request->alt;

        $post->tag_id = implode(",",$request->tag); 
               
        $post->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $image_path = public_path() . '/front/images/post/' . $post->image;
            if (File::exists($image_path)) {
                File::delete($image_path);
                $file = $request->file('image');
                $extension = strtolower($file->getClientOriginalName());
                $fileName = time() . '-' . 'post-image' . '.' . $extension;
                $file->move('front/images/post', $fileName);
                $post->image = $fileName;
            } 
        } 


        $post->save();

        // Tags attach without save;
        $post->tag()->detach();
        $tags = $request->tag;
        foreach($tags as $tag) {
            $post->tag()->attach($tag);
        }

       

        return redirect()->route('post.index');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $image_path = public_path() . '/front/images/post/' . $post->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        } 
        
        $post->tag()->detach();
        $post->delete();
        return redirect()->route('post.index');

    }
}
