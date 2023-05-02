<?php declare(strict_types=1);

namespace App\Models;

use GuzzleHttp\Client;

class GifApiClient
{
    private Client $client;
    private GifsCollection $gifsList;

    public function __construct()
    {
        $this->client = new Client();
        $this->gifsList = new GifsCollection();
    }

    public function getSearchContents($search, $limit): GifsCollection
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

    public function getTrendingContents(): GifsCollection
    {
        $parameters = [
            'api_key' => $_ENV['API_KEY'],
            'limit' => 12,
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