<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function likeIt(Reply $reply) {
        $reply->likes()->create(['user_id' => auth()->user()->id]);
        broadcast(new LikeEvent($reply->id, 1))->toOthers();
        return response($reply->likes, Response::HTTP_CREATED);
    }

    public function unLikeIt(Reply $reply) {
        $reply->likes()->where('user_id', auth()->user()->id)->first()->delete();
        broadcast(new LikeEvent($reply->id, 0))->toOthers();
        return response($reply->likes, Response::HTTP_CREATED);
    }
}
