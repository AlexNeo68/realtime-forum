<?php

namespace App\Notifications;

use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DeleteReplyNotification extends Notification
{
    use Queueable;

    protected $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'reply_by' => $this->reply->user->name,
            'question' => $this->reply->question->title,
            'question_path' => $this->reply->question->path,
        ];
    }

    public function toBroadcast($notifiable) {
       return new BroadcastMessage([
           'reply_by' => $this->reply->user->name,
            'question' => $this->reply->question->title,
            'question_path' => $this->reply->question->path,
           'reply' => new ReplyResource($this->reply),
       ]);
    }


}
