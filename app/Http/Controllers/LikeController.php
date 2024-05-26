<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like (Request $request, User $user) {
        $user->likes()->attach($request->post_id);

        return response('');
    }

    public function unlike (Request $request, User $user) {
        $user->likes()->detach($request->post_id);

        return response('');
    }
}
