<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\GifApiClient;
use App\View;

class GifsController
{
    public function getSearchedGifs(): View
    {
        $apiClient = new GifApiClient();
        $gifsList = $apiClient->getSearchContents("{$_POST["search"]}", "{$_POST["limit"]}");
        return new View('gifs', ['gifs' => $gifsList->getGifsCollection()]);
    }

    public function getTrendingGifs(): View
    {
        $apiClient = new GifApiClient();
        $gifsList = $apiClient->getTrendingContents();
        return new View('gifs', ['gifs' => $gifsList->getGifsCollection()]);
    }
}