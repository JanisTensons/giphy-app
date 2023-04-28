<?php declare(strict_types=1);

namespace App\Models;

use GuzzleHttp\Client;

class GiphyApiClient
{
    private Client $client;
    private GifsList $gifsList;

    public function __construct()
    {
        $this->client = new Client();
        $this->gifsList = new GifsList();
    }

    public function getSearchContents($search, $limit): GifsList
    {
        $parameters = [
            'api_key' => $_ENV['API_KEY'],
            'limit' => $limit,
            'offset' => rand(1, 100)
        ];
        $queryString = http_build_query($parameters);
        $url = "https://api.giphy.com/v1/gifs/search?q=$search&$queryString";
        $response = $this->client->request('GET', $url);
        $giphyContents = json_decode($response->getBody()->getContents());

        foreach ($giphyContents->data as $gif) {
            $this->gifsList->add(new Gif(
                $gif->title,
                $gif->images->downsized_medium->url
            ));
        }
        return $this->gifsList;
    }

    public function getTrendingContents(): GifsList
    {
        $parameters = [
            'api_key' => $_ENV['API_KEY'],
            'limit' => 8,
            'offset' => rand(1, 100)
        ];
        $queryString = http_build_query($parameters);
        $url = "https://api.giphy.com/v1/gifs/trending?$queryString";
        $response = $this->client->request('GET', $url);
        $giphyContents = json_decode($response->getBody()->getContents());

        foreach ($giphyContents->data as $gif) {
            $this->gifsList->add(new Gif(
                $gif->title,
                $gif->images->downsized_medium->url
            ));
        }
        return $this->gifsList;
    }
}