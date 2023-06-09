<?php declare(strict_types=1);

namespace App\Models;

class Gif
{
    private string $title;
    private string $url;

    public function __construct(
        string $title,
        string $url
    )

    {
        $this->title = $title;
        $this->url = $url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}