<?php

namespace App\Services;

use InstagramScraper\Instagram;
use GuzzleHttp;
use Symfony\Component\Cache\Adapter\Psr16Adapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;

class InstagramServices
{
    private mixed $connexion;
    private mixed $psr6Cache;

    public function __construct()
    {
        $this->psr6Cache = new FilesystemAdapter();
        $this->getLogin();
    }

    public function getLogin(): void
    {
        $this->connexion = new Instagram(new GuzzleHttp\Client());
    }

    public function getImages(int $numberOfImages): Response
    {
        return $this->connexion->getMediasByUserId('1463798983', $numberOfImages);
    }
}
