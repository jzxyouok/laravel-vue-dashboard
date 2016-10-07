<?php

namespace App\Components\VonageApi;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use BobFridley\Vonage\Facades\Vonage;
use App\Components\VonageApi\Exceptions\BadResponse;

class VonageApi
{
    /**
     * [$base_uri description]
     * 
     * @var string
     */
    public $base_uri = 'https://my.vonagebusiness.com';

    /**
     * [$cookie description]
     * 
     * @var [type]
     */
    private $cookie;

    /**
     * [$client description]
     * 
     * @var [type]
     */
    private $client;

    /**
     * [$auth description]
     * 
     * @var array
     */
    public $auth = array();

    /**
     * [__construct description]
     *
     * @param string $connection
     *
     * @return \Vonage\Client
     *
     * @throws App\Components\Vonage\Exceptions\BadResponse
     */
    public function __construct($connection = 'main')
    {
        $this->client = Vonage::connection($connection);
        $this->auth = Vonage::getConnectionConfig($connection);
    }
    
    public function makeRequest($uri)
    {
        $request = $this->client->get($uri, [
            'cookies' => $this->cookie,
            'query' => [
                    'htmlLogin' => $this->auth['username'],
                    'htmlPassword' => $this->auth['password']
                ],
                'headers' => ['X-Vonage' => 'vonage']
            ]);

        $headers = $request->getHeaders();

        if (!isset($request)) {
            throw BadResponse::create($request);
        }

        $response = json_decode($request->getBody()->getContents(), true);

        return $response;
    }

    public function getExtensions()
    {
        $uri = $this->base_uri . '/presence/rest/directory';

        $extensions = $this->makeRequest($uri);

        return $extensions;
    }

    public function getCallDetails($extension)
    {
        $uri = $this->base_uri . "/presence/rest/extension/{$extension}";

        $callDetails = $this->makeRequest($uri);
//dd($callDetails);
        return $callDetails;
    }
}
