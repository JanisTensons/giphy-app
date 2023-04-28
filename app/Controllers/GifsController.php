<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\GiphyApiClient;

class GifsController
{
    public function getSearchedGifs()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/Views');
        $twig = new \Twig\Environment($loader);
        $apiClient = new GiphyApiClient();
        $gifsList = $apiClient->getSearchContents('coding', '8');
        echo $twig->render('gifs.view.twig', ['gifs' => $gifsList->getList()]);
    }

    public function getTrendingGifs()
    {
        $loader = new \Twig\Loader\FilesystemLoader('app/Views');
        $twig = new \Twig\Environment($loader);
        $apiClient = new GiphyApiClient();
        $gifsList = $apiClient->getTrendingContents();
        echo $twig->render('gifs.view.twig', ['gifs' => $gifsList->getList()]);
    }
}