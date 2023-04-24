<?php declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;

class GiphyApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getGiphyContents($search, $limit): array
    {
        $apiKey = $_ENV['API_KEY'];
        $url = "https://api.giphy.com/v1/gifs/search?q=$search&api_key=$apiKey&limit=$limit";
        $response = $this->client->request('GET', $url);
        $giphyContents = json_decode($response->getBody()->getContents());
        return $giphyContents->data;
    }
}