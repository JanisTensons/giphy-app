<?php declare(strict_types=1);

namespace App\Models;

class GifsList
{
    private array $list = [];

    public function add(Gif $gif): void
    {
        $this->list[] = $gif;
    }

    public function getList(): array
    {
        return $this->list;
    }
}