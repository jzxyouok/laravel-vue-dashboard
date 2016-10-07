<?php

return [

    /**
     * Path to a json file containing the credentials of a Google Service account.
     */
    'client_secret_json' => storage_path('app/laravel-google-calendar/client_secret.json'),

    /**
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => env('SB_GOOGLE_CALENDAR_ID'),

    /**
     *  The id of the Diversified Google Calendar.
     */
    'dtc_calendar_id' => env('DTC_GOOGLE_CALENDAR_ID'),

    /**
     *  The id of the Service Bureau Google Calendar.
     */
    'sb_calendar_id' => env('SB_GOOGLE_CALENDAR_ID'),
    
];
