<?php declare(strict_types=1);

use App\GiphyApiClient;

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Giphy-app</title>
</head>
<body>
<header>GIPHY APP</header>
<br>
<form action="" method="POST">
    Search: <input type="text" name="search"><br><br>
    Limit: <input type="text" name="limit"><br><br>
    <input type="Submit"><br><br>
</form>

<?php
$apiClient = new GiphyApiClient();
if (isset($_POST["search"])) {
    $gifsList = $apiClient->getGiphyContents($_POST["search"], $_POST["limit"]);
    foreach ($gifsList as $gif) {
        $gifUrl = $gif->images->downsized_medium->url;
        echo " <img src=' $gifUrl' alt='gif'>";
    }
}
?>

</body>
</html>