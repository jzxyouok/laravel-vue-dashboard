<?php

namespace App\Components\Freshdesk;

use App\Models\FreshdeskContacts;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Carbon\Carbon;
use DateTime;
use App\Components\Freshdesk\Exceptions\BadResponse;
use DB;

class Freshdesk
{
    /**
     * [$username description]
     * 
     * @var string
     */
    protected $apiKey;

    /**
     * [$password description]
     * 
     * @var string
     */
    protected $password;

    /**
     * [$domain description]
     * 
     * @var string
     */
    protected $domain;

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
     * [__construct description]
     *
     * @param string $apiKey
     * @param string $password
     *
     * @throws App\Components\Freshdesk\Exceptions\BadResponse
     */
    public function __construct($apiKey, $password, $domain)
    {
        $this->apiKey = $apiKey;
        $this->password = $password;
        $this->domain = $domain;
        
        $this->client = new Client();
        $this->cookie = new CookieJar();
    }

    public function makeRequest($uri)
    {
        $request = $this->client->get($uri, [
            'auth' => [$this->apiKey, $this->password],
            'header' => ['X-freshdesk' => 'freshdesk']
        ]);

        $headers = $request->getHeaders();

        if (!isset($request)) {
            throw BadResponse::create($request);
        }

        $response = json_decode($request->getBody()->getContents(), true);

        return $response;
    }

    public function getTicketsSinceYesterday()
    {
        $updated_since = Carbon::now()->subDay()->format('Y-m-d\TH:i:s\Z');

        $uri = 'https://' . $this->domain . '/api/v2/tickets?updated_since=' . $updated_since . '&per_page=5&page=1&order_by=created_at&order_type=desc';
        $response = $this->makeRequest($uri);

        return $response;
    }

    public function getCompany($company_id)
    {
        $uri = 'https://' . $this->domain . '/api/v2/companies/' . $company_id;
        $response = $this->makeRequest($uri);

        return $response;
    }

    public function getRequester($requester_id)
    {
        $uri = 'https://' . $this->domain . '/api/v2/contacts/' . $requester_id;
        $response = $this->makeRequest($uri);

        return $response;
    }

    public function getAgent($responder_id)
    {
        $uri = 'https://' . $this->domain . '/api/v2/agents/' . $responder_id;
        $response = $this->makeRequest($uri);

        return $response;
    }

    public function getGroup($group_id)
    {
        $uri = 'https://' . $this->domain . '/api/v2/groups/' . $group_id;
        $response = $this->makeRequest($uri);

        return $response;
    }

    public static function getCompanyByPhone($phone)
    {
        $response = FreshdeskContacts::where('phone', '=', $phone)
            ->limit(1)
            ->offset(0)
            ->get()
            ->map(function ($freshdesk) {
                return [
                    'company' => $freshdesk->company
                ];
            })
            ->toArray();

        return $response;
    }
}
