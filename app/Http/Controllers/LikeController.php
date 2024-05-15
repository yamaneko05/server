<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store (Request $request) {
        $like = new Like();
        $like->user_id = $request->user()->id;
        $like->post_id = $request->post_id;
        $like->save();

        return $like;
    }

    public function destroy (Request $request, Like $like) {
        $like->delete();

        return response('');
    }
}
