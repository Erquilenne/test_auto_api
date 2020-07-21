<?php


namespace App\miniSDK;


use GuzzleHttp\Client;

class AutoApi
{
    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getItems(string $method, string $url, array $params): string
    {
        $client = new Client();

        $response = $client->request($method, $url, $params);

        $html = $response->getBody();

        return $html;

    }
}