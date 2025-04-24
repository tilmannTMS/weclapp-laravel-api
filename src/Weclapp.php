<?php

namespace TilmannTMS\Weclapp;

use GuzzleHttp\Client;
use TilmannTMS\Weclapp\Exceptions\WeclappException;

class Weclapp
{
    protected $client;
    protected $baseUrl;
    protected $apiToken;

    public function __construct($app)
    {
        $this->baseUrl = config('weclapp.base_url');
        $this->apiToken = config('weclapp.api_token');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'AuthenticationToken' => $this->apiToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'timeout' => config('weclapp.timeout'),
        ]);
    }

    /**
     * Make a GET request to the Weclapp API
     */
    public function get(string $endpoint, array $params = [])
    {
        try {
            $response = $this->client->get($endpoint, [
                'query' => $params
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new WeclappException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Make a POST request to the Weclapp API
     */
    public function post(string $endpoint, array $data = [])
    {
        try {
            $response = $this->client->post($endpoint, [
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new WeclappException($e->getMessage(), $e->getCode(), $e);
        }
    }

    // Add other methods (put, delete, etc.) as needed
}