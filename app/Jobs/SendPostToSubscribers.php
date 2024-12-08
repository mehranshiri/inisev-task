<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Post;
use App\Models\PostSentLog;
use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendPostToSubscribers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post, $subscriber;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post, Subscriber $subscriber)
    {
        $this->post = $post;
        $this->subscriber = $subscriber;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->subscriber->email)->send(new \App\Mail\PostPublishedMail($this->post));

        // Mark the post as sent to prevent duplicate sends
        PostSentLog::create(['post_id' => $this->post->id, 'subscriber_id' => $this->subscriber->id]);

    }
}
