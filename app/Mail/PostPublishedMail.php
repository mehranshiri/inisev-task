<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PostPublishedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function build()
    {
        Log::info("Sending email for new post: {$this->post->title}");
        Log::info("Post Description: {$this->post->description}");

        return $this->view('emails.posts')  // Referencing the newly created view
                    ->subject('New Post Published: ' . $this->post->title)
                    ->with([
                        'post' => $this->post,
                    ]);
    }
}
