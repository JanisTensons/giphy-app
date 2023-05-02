<?php declare(strict_types=1);

namespace App\Models;

class GifsCollection
{
    private array $gifs = [];

    public function add(Gif $gif): void
    {
        $this->gifs[] = $gif;
    }

    public function getGifsCollection(): array
    {
        return $this->gifs;
    }
}