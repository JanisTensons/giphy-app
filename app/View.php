<?php

namespace App;

class View
{
    private string $template;
    private array $gifsList;

    public function __construct(string $template, array $gifsList)
    {
        $this->template = $template;
        $this->gifsList = $gifsList;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function getGifsList(): array
    {
        return $this->gifsList;
    }

}