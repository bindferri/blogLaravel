<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index(){
        return view('admin.posts.index',[
            'posts' => Post::paginate(50)
        ]);
    }

    public function create(){
        return view('admin.posts.create');
    }

    public function validatePost(Post $post){
        return request()->validate([
            'title' => ['required',Rule::unique('posts','title')->ignore($post)],
            'thumbnail' => $post->exists ? ['image'] : ['required','image'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required',Rule::exists('categories','id')],
            'status' => 'required'
        ]);
    }

    public function store(){
        $post = new Post();
        $slug = Str::slug(request('title'));
        $attributes = $this->validatePost($post);

        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        $attributes['slug'] = $slug;
        $attributes['user_id'] = auth()->id();

        Post::create($attributes);
        return redirect('/');
    }

    public function edit(Post $post){
        return view('admin.posts.edit',[
            'post' => $post
        ]);
    }

    public function update(Post $post){
        $slug = Str::slug(request('title'));
        $attributes = $this->validatePost($post);

        if (isset($attributes['thumbnail'])){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $attributes['slug'] = $slug;
        $attributes['user_id'] = \request('author');

        $post->update($attributes);
        return back()->with('success','UPDATED SUCCESSFULLY');
    }

    public function destroy(Post $post){
        $post->delete();

        return back()->with('success','Deleted SUCCESSFULLY');
    }
}
