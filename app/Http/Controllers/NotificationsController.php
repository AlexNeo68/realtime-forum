<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificatonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class NotificationsController extends Controller
{

    public function index()
    {
        return response([
            'read' => NotificatonResource::collection(auth()->user()->readNotifications),
            'unread' => NotificatonResource::collection(auth()->user()->unreadNotifications),
        ], Response::HTTP_OK);
    }


    public function markAsRead($notification_id)
    {

        $notification = auth()->user()->notifications()->where('id', $notification_id)->first()->markAsRead();

        return response($notification, Response::HTTP_ACCEPTED);
    }


}
