<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogAPIController extends Controller
{
    public function index(Request $request)
    {
        $blogsQry = Blog::query();

        $blogsQry->when(
            $request->keyword,
            fn ($query) =>
                $query->where('title', 'LIKE', '%'.$request->keyword.'%')
                    ->orWhere('body', 'LIKE', '%'.$request->keyword.'%')
            );
        $blogs = $blogsQry->latest()->paginate(5);

        return response()->json([
            'success' => true,
            'data' => $blogs
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'image' => [
                'sometimes',
                'mimes:png,jpg,jpeg',
                'nullable'
            ]
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $attrs = $request->only(app(Blog::class)->getFillable());
        $attrs['creator_id'] = auth()->id();

        $blog = Blog::create($attrs);

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filePath = $image->storeAs('public/blogs', Str::random(5).'.'.$extension);

            $storagePath = Storage::url($filePath);

            $blog->image()->create([
                'path' => $storagePath
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Blog Created'
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, Blog $blog)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'image' => [
                'sometimes',
                'mimes:png,jpg,jpeg',
                'nullable'
            ]
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'error' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $attrs = $request->only(app(Blog::class)->getFillable());
        $blog->update($attrs);

        if($request->hasFile('image')) {
            if($blog->image && File::exists($blog->image->path)) {
                File::delete($blog->image->path);
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filePath = $image->storeAs('public/blogs', Str::random(5).'.'.$extension);

            $storagePath = Storage::url($filePath);

            $blog->image()->create([
                'path' => $storagePath
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Blog Updated',
            'data' => $blog
        ], Response::HTTP_OK);
    }

    public function delete(Request $request, Blog $blog)
    {
        if($blog->image && File::exists($blog->image->path)) {
            File::delete($blog->image->path);
        }

        $blog->delete();

        return response()->json([
            'succes' => true,
            'message' => 'Blog Deleted!',
            'data' => null
        ], Response::HTTP_OK);
    }
}
