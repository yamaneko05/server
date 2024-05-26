<?php

namespace App\Http\Controllers;

use App\Models\Following;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show (User $user) {
        return [
            'user' => $user,
            'posts' => $user->posts
        ];
    }

    public function update (Request $request, User $user) {
        $icon_file = $request->file('icon_file');

        $user->name = $request->name;
        $user->bio = $request->bio;
        if ($icon_file) {
            $user->icon_file = $icon_file[0]->store('icons', 'public');
        }
        $user->save();

        return $user;
    }
}
