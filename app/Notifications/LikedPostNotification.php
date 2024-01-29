<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use Illuminate\Bus\Queueable;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LikedPostNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
        $this->likedUser = Auth::user();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user' => [
                'id'            =>  $this->user->id,
                'name'          =>  $this->user->name,
                'username'      =>  $this->user->username,
                'avatar'        =>  $this->user->profile_photo_url,
            ],
            'post'              =>  PostResource::make($this->post),
            'type'              =>  'like',
            'likedUser'  =>  [
                'id'            =>  $this->likedUser->id,
                'name'          =>  $this->likedUser->name,
                'username'      =>  $this->likedUser->username,
                'avatar'        =>  $this->likedUser->profile_photo_url,
            ],
        ];
    }
}
