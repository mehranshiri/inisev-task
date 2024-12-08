<?php

namespace App\Services;

use App\Contracts\PostNotificationServiceInterface;

use App\Models\PostSentLog;
use Illuminate\Support\Facades\Mail;

class PostNotificationService implements PostNotificationServiceInterface
{
    public function sendPostToSubscribers($post)
    {
        foreach ($post->website->subscribers as $subscriber) {
            // Send email to each subscriber
            Mail::to($subscriber->email)->send(new \App\Mail\PostPublishedMail($post));
            PostSentLog::create(['post_id' => $post->id, 'subscriber_id' => $subscriber->id]);
        }
    }
}
