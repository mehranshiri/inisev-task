<?php

namespace App\Console\Commands;

use App\Contracts\PostNotificationServiceInterface;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class SendNewPostEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to all subscribers of websites for new posts';

    /**
     * Execute the console command.
     */
    public function handle(PostNotificationServiceInterface $notificationService)
    {
        $websites = Website::with(['posts' => function ($query) {
            $query->whereDoesntHave('sentLogs');
        }])->get();
    
        foreach ($websites as $website) {
            // Cache the posts that need to be sent, if not cached already
            $postsCacheKey = "website_{$website->id}_posts_to_send";
            $posts = Cache::remember($postsCacheKey, now()->addMinutes(10), function () use ($website) {
                return $website->posts()->whereDoesntHave('sentLogs')->get();
            });
    
            foreach ($posts as $post) {
                $notificationService->sendPostToSubscribers($post);
            }
        }
    }
    
}
