<?php

namespace App\Components\FullCalendar;

use App\Events\FullCalendar\DiversifiedEventsFetched;
use App\Events\FullCalendar\ServiceBureauEventsFetched;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Console\Command;
use Spatie\GoogleCalendar\Event;

class FetchFullCalendarEvents extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:fullcalendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch All Calendar events.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $this->getDiversifiedCalendar();

        $this->getServiceBureauCalendar();
    }

    public function getDiversifiedCalendar()
    {
        $events = $this->makeRequest(config('laravel-google-calendar.dtc_calendar_id'));
        
        event(new DiversifiedEventsFetched($events));
    }

    public function getServiceBureauCalendar()
    {
        $events = $this->makeRequest(config('laravel-google-calendar.sb_calendar_id'));

        event(new ServiceBureauEventsFetched($events));
    }

    public function makeRequest($calendar_id)
    {
        $events = collect(Event::get(Carbon::now(), null, [], $calendar_id))
            ->map(function (Event $event) {
                $dt_start = !is_null($event->startDateTime) ? $event->startDateTime : $event->startDate;
                $dt_end = !is_null($event->endDateTime) ? $event->endDateTime : $event->endDate;
                $dt_allDay = is_null($event->startDateTime);

                $dt_start->setTimezone($dt_start->getTimezone());
                $dt_end->setTimezone($dt_end->getTimezone());

                return [
                    'id'     => $event->id,
                    'title'  => $event->name,
                    'start'  => Carbon::createFromFormat('Y-m-d H:i:s', $dt_start)->format(DateTime::ATOM),
                    'end'    => Carbon::createFromFormat('Y-m-d H:i:s', $dt_end)->format(DateTime::ATOM),
                    'date'   => Carbon::createFromFormat('Y-m-d H:i:s', $event->getSortDate())->format(DateTime::ATOM),
                    'allDay' => $dt_allDay,
                ];
            })
            ->unique('name')
            ->toArray();

        return $events;
    }
}
