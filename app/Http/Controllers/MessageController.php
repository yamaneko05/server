<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index (Room $room) {
        return $room->messages()->orderBy('created_at')->get();
    }

    public function store (Request $request, Room $room) {
        $message = new Message();
        $message->user_id = $request->user()->id;
        $message->text = $request->text;
        $room->messages()->save($message);

        return $message;
    }
}
