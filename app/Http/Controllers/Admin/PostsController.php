<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends BaseController
{
    public function index()
    {
        if (current_user()->type === 1) {
            $posts = current_user()->posts()->latest()->paginate(10);
        } else {
            $posts = Post::all();
        }
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $user = current_user();
        if ($user->isPostable()) {
            return view('admin.posts.create');
        } else {
            session()->flash('message-danger', 'Upgrade to premium first');
            return back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "attachment" => "nullable|file|image"
        ]);

        $path = null;
        if ($request->attachment) {
            $path = $request->attachment->store('public/post-attachments');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }

        $query = current_user()->posts();
        $post = $query->create([
            "title" => $request->title,
            "description" => $request->description,
            "attachment" => $path,
        ]);
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " created new Post (POST ID#" . $post->id . ")");
        session()->flash('message-success', "Post created!");

        return redirect('admin/posts');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "description" => "required|string",
            "attachment" => "nullable|file|image"
        ]);

        $path = null;
        if ($request->attachment) {
            $path = $request->attachment->store('public/post-attachments');
            $prefix = 'public/';
            if (substr($path, 0, strlen($prefix)) == $prefix) {
                $path = substr($path, strlen($prefix));
            }
        }
        if ($path) {
            if ($post->attachment) {
                Storage::delete('public/' . $post->attachment);
            }
            $post->attachment = $path;
        }
        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " updated Post (POST ID#" . $post->id . ")");
        session()->flash('message-success', "Post updated!");

        return redirect('admin/posts');
    }

    public function deletePhoto(Request $request, Post $post)
    {
        if ($post->attachment) {
            Storage::delete('public/' . $post->attachment);
        }
        $post->attachment = null;
        $post->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deleted Post photo (POST ID#" . $post->id . ")");
        return response()->json([], 200);
    }

    public function destroy(Request $request, Post $post)
    {
        $post = $post->delete();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " deleted Post (POST ID#" . $post->id . ")");
        session()->flash('message-success', "Post deleted.");
        return redirect('admin/posts');
    }
}
