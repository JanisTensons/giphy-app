<?php declare(strict_types=1);

use App\GiphyApiClient;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require 'app/Views/view.php';

$apiClient = new GiphyApiClient();
if (isset($_POST["search"])) {
    $gifsList = $apiClient->getGiphyContents($_POST["search"], $_POST["limit"]);
    foreach ($gifsList as $gif) {
        $gifUrl = $gif->images->downsized_medium->url;
        echo " <img src=' $gifUrl' alt='gif'>";
    }
}