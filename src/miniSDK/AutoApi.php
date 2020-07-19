<?php


namespace App\miniSDK;


use GuzzleHttp\Client;

class AutoApi
{
    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getItems(string $method, string $url,  $params) :array
    {
        $client = new Client();

        $response = $client->request($method, $url, $params);
        var_dump($response);
//        $html = $response->getBody();

//        return $html;

    }
}