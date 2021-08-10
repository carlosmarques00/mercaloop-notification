<?php

namespace App\Services\Notification;

use GuzzleHttp\Client;

class NotificationService
{
    protected $client;
    protected $token;

    public function __construct(string $urlBase, string $token)
    {
        $this->client = new Client(['base_uri' => $urlBase]);
        $this->token = $token; 
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
