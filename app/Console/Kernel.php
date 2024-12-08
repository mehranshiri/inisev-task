<?php

namespace App\Console;

use App\Console\Commands\SendNewPostEmails;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendNewPostEmails::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:posts')->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
