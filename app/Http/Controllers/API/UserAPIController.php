<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Response;

class UserAPIController extends Controller
{
    public function show(User $user)
    {
        $blogs = Blog::where('creator_id', $user->id)->paginate(6);
        $user->blogs = $blogs;

        return response()->success(
            UserResource::make($user),
            '',
            200
        );
    }
}
