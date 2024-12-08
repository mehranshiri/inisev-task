<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Models\PostSentLog;
use Illuminate\Support\Facades\Mail;

class SendPostToSubscribers
{
    public function handle(PostPublished $event)
    {
        $post = $event->post;

        foreach ($post->website->subscribers as $subscriber) {
            // Send email to subscriber
            Mail::to($subscriber->email)->send(new \App\Mail\PostPublishedMail($post));

            PostSentLog::create(['post_id' => $post->id, 'subscriber_id' => $subscriber->id]);
        }
    }
}
