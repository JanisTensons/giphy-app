<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giphy-app</title>
    <link rel="stylesheet" href="app/Views/styles.css"/>
</head>
<body>
<h1>GIPHY APP</h1>
<form method="POST" action="search">
    <fieldset>
        <label for="search">Search: <input id="search" name="search" type="text" required/></label>
        <label for="limit">Limit: <input id="limit" name="limit" type="number" min="1" required/></label>
    </fieldset>
    <input type="submit" value="Search GIFs">
    <button onclick="location.href='trending'" type="submit">Search Trending GIFs</button>
</form>
</body>
</html>