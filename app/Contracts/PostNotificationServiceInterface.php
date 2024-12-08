<?php

namespace App\Contracts;

interface PostNotificationServiceInterface
{
    public function sendPostToSubscribers($post);
}