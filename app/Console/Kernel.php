<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Components\GoogleCalendar\FetchGoogleCalendarEvents::class,
        \App\Components\LastFm\FetchCurrentTrack::class,
        \App\Components\VonageApi\FetchVonageExtensions::class,
        \App\Components\Freshdesk\FetchFreshdeskTickets::class,
        \App\Components\Payment\FetchBillPayments::class,
        \App\Components\GoogleTasks\FetchGoogleTasks::class,
        \App\Components\FullCalendar\FetchFullCalendarEvents::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('dashboard:lastfm')->everyMinute();
        $schedule->command('dashboard:calendar')->everyFiveMinutes();
        $schedule->command('dashboard:vonage')->everyMinute();
        $schedule->command('dashboard:freshdesk')->everyMinute();
        $schedule->command('dashboard:payment')->everyMinute();
        $schedule->command('dashboard:task')->everyMinute();
        $schedule->command('dashboard:fullcalendar')->everyMinute();
    }
}
