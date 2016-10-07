<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Spatie\GoogleCalendar\Event;

class FullCalendarController extends Controller
{
	public function getServiceBureauCalendar()
    {
        $events = [];

        $calenderEvents = $this->makeRequest(config('laravel-google-calendar.sb_calendar_id'));

        foreach ($calenderEvents as $event) {
            $events[] = \Calendar::event(
                $event['title'], // event title
                $event['allDay'], // full day event?
                new \DateTime($event['start']), // start time (you can also use Carbon instead of DateTime)
                new \DateTime($event['end']), // end time (you can also use Carbon instead of DateTime)
                $event['id'] // optionally, you can specify an event ID
            );
        }

        $calendar = \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'color' => '#800',
                'firstDay' => 1,
                'editable' => true,
                'theme' => false,
                'height' => 900
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
                'viewRender' => 'function() {console.log("Callbacks!");}'
            ]);

        // $pusherKey = config('broadcasting.connections.pusher.key');

        // return view('calendar')->with(compact('pusherKey'))->with(compact('calendar'));
        return view('calendar')->with(compact('calendar'));
    }

    public function makeRequest($calendar_id)
    {
        $calenderEvents = collect(Event::get(Carbon::now(), null, [], $calendar_id))
            ->map(function (Event $event) {
                $dt_start = !is_null($event->startDateTime) ? $event->startDateTime : $event->startDate;
                $dt_end = !is_null($event->endDateTime) ? $event->endDateTime : $event->endDate;
                $dt_allDay = is_null($event->startDateTime);

                $dt_start->setTimezone($dt_start->getTimezone());
                $dt_end->setTimezone($dt_end->getTimezone());

                return [
                    'title'  => $event->name,
                    'allDay' => $dt_allDay,
                    'start'  => Carbon::createFromFormat('Y-m-d H:i:s', $dt_start)->format(DateTime::ATOM),
                    'end'    => Carbon::createFromFormat('Y-m-d H:i:s', $dt_end)->format(DateTime::ATOM),
                    'date'   => Carbon::createFromFormat('Y-m-d H:i:s', $event->getSortDate())->format(DateTime::ATOM),
                    'id'     => $event->id,
                ];
            })
            // ->unique('title')
            ->toArray();

        return $calenderEvents;
    }
}
