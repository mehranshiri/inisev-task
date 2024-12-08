<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request, Website $website)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email,NULL,id,website_id,' . $website->id,
        ]);        

        $subscriber = $website->subscribers()->create($validated);

        return response()->json(['message' => 'Subscribed successfully.', 'subscriber' => $subscriber], 201);
    }

}
