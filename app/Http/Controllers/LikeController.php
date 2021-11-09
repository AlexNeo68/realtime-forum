<?php

namespace App\Http\Controllers;

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
        $reply->likes()->create(['user_id' => 1]);
        return response($reply->likes, Response::HTTP_CREATED);
    }

    public function unLikeIt(Reply $reply) {
        $reply->likes()->where('user_id', 1)->first()->delete();
        return response($reply->likes, Response::HTTP_CREATED);
    }
}
