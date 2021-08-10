<?php

namespace carlosmarques00\mercaloopNotification\Services;

use GuzzleHttp\Client;
use Tymon\JWTAuth\JWTAuth;
class Notification
{
    protected $client;
    protected $token;

    public function __construct(string $urlBase)
    {
        $this->client = new Client(['base_uri' => $urlBase]);
        $this->token = JWTAuth::getToken()->get(); 
    }

    public function newNotification(
        string $title,
        string $description,
        string $clientId,
        string $typeClient,
        string $href,
        string $type,
        string $media,
        string $channel
    ) {

        $request = $this->client->post('/api/notification/create', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'title' => $title,
                'description' => $description,
                'client_id' => $clientId,
                'type_client' => $typeClient,
                'href' => $href,
                'type' => $type,
                'media' => $media,
                'channel' => $channel
            ]
        ]);
        $response = $request->getbody()->getContents();
        return json_decode($response, true);

    }
}
