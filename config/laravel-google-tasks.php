<?php

return [

    /**
     * Path to a json file containing the credentials of a Google Service account.
     */
    'client_secret_json' => storage_path('app/laravel-google-tasks/client_secret.json'),

    /**
     * Path to a private_key file.
     */
    'private_key' => storage_path('app/laravel-google-tasks/dtc-dashboard.p12'),

    /**
     * Client email.
     */
    'client_email' => 'dtc-tasks@dtc-dashboard.iam.gserviceaccount.com',
    
    /**
     * User to impersonate.
     */
    'user_to_impersonate' => 'diversifiedtechnologycorp@gmail.com',
 
];