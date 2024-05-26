<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Following;
use App\Models\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function followings (User $user) {
        return $user->followings;
    }

    public function followers (User $user) {
        return $user->followers;
    }

    public function follow (Request $request, User $user) {
        $user->followings()->attach($request->followee_id);

        return response('');
    }

    public function unfollow (Request $request, User $user) {
        $user->followings()->detach($request->followee_id);

        return response('');
    }
}
