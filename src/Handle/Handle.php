<?php

namespace ShortUrl\Handle;

use GuzzleHttp\Client;

class Handle
{
    protected $host = null;

    protected $path = null;

    protected $client = null;

    protected $options = null;

    protected $response = null;

    public function __construct()
    {
        $this->client = new Client(
            [
                'base_uri' => $this->host,
            ]
        );
    }

    public function send($method, $uri = '/', $options = [])
    {
        $this->response = $this->client->request($method, $uri, $options);

        return $this->response->getBody()->getContents();
    }

    public function getResponse()
    {
        return $this->response;
    }
}
