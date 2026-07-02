<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminPostController extends Controller
{
    // List all posts in admin panel
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    // Show create post form
    public function create()
    {
        return view('admin.posts.create');
    }

    // Store new post in database
    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:posts,slug|max:255',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ], [
            'slug.unique' => 'Slug bài viết đã tồn tại.',
            'slug.required' => 'Đường dẫn slug là bắt buộc.',
            'title.required' => 'Tiêu đề bài viết không được để trống.',
        ]);

        // Handle is_published
        $data['is_published'] = $request->has('is_published') ? (bool)$request->is_published : true;

        // Handle Image Upload
        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $data['image_path'] = 'uploads/posts/' . $filename;
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success_message', 'Thêm bài viết mới thành công!');
    }

    // Show edit post form
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // Update post in database
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:posts,slug,' . $post->id . '|max:255',
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_desc' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ], [
            'slug.unique' => 'Slug bài viết đã tồn tại.',
            'slug.required' => 'Đường dẫn slug là bắt buộc.',
            'title.required' => 'Tiêu đề bài viết không được để trống.',
        ]);

        // Handle is_published
        $data['is_published'] = $request->has('is_published') ? (bool)$request->is_published : false;

        // Handle Image Upload
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($post->image_path && File::exists(public_path($post->image_path))) {
                File::delete(public_path($post->image_path));
            }

            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/posts'), $filename);
            $data['image_path'] = 'uploads/posts/' . $filename;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success_message', 'Cập nhật bài viết thành công!');
    }

    // Delete post
    public function destroy(Post $post)
    {
        // Delete image if exists
        if ($post->image_path && File::exists(public_path($post->image_path))) {
            File::delete(public_path($post->image_path));
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success_message', 'Xóa bài viết thành công!');
    }
}
