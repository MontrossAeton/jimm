<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function my_posts()
    {
        $posts = auth()->user()->posts()->orderBy('created_at', 'desc')->get();
        return view('posts.my_posts', compact('posts'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user->isPostable()) {
            session()->flash('message-danger', 'Upgrade to premium first');
            return back();
        }

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
        $query = auth()->user()->posts();
        $post = $query->create([
            "title" => trim($request->title),
            "description" => trim($request->description),
            "attachment" => $path,
        ]);
        session()->flash('message-success', 'Post created!');
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " created new Post (POST ID#" . $post->id . ")");

        return redirect('/posts');
    }

    public function show($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        if ($post->trashed() && $post->user_id !== auth()->id()) {
            abort(404);
        }
        $comments = $post->load('user')->comments()->with('user')->get();
        return view('posts.show', compact('post', 'comments'));
        //
    }

    public function edit(Request $request, Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|string|max:255",
            "description" => "required|string",
            "attachment" => "nullable|file|image"
        ]);

        if ($validator->fails()) {
            return redirect('/posts')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('post-id-error', $post->id);
        }

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
        $post->title = trim($request->title);
        $post->description = trim($request->description);
        $post->save();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " updated Post (POST ID#" . $post->id . ")");
        session()->flash('message-success', 'Post updated!');

        return redirect('/posts');
    }

    public function deletePhoto(Request $request, Post $post)
    {
        if ($post->attachment) {
            Storage::delete('public/' . $post->attachment);
        }
        $post->attachment = null;
        $post->save();

        return response()->json([], 200);
    }

    public function destroy(Request $request, Post $post)
    {
        //if ($post->attachment) {
        //    Storage::delete('public/' . $post->attachment);
        //}
        $post->delete();
        $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " archived Post (POST ID#" . $post->id . ")");
        session()->flash('message-success', 'Post archived.');

        return redirect('/posts');
    }

    public function restore(Request $request, $id)
    {
        if (auth()->user()->isPostable()) {
            $post = Post::onlyTrashed()->findOrFail($id);
            $post->restore();
            $this->audit->log(auth()->user(), "(USER ID#" . auth()->id() . ") " . auth()->user()->name . " restored Post (GYM ID#" . $gym->id . ")");
            session()->flash('message-success', "Post restored.");
        } else {
            session()->flash('message-success', "Post not restored. Please upgrade to premium first.");
        }
        return redirect('/posts');
    }
}
