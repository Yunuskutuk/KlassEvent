<?php

namespace App\Services;

use InstagramScraper\Instagram;
use GuzzleHttp;
use Symfony\Component\Cache\Adapter\Psr16Adapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class InstagramServices
{
    private $connexion;
    private $psr6Cache;

    public function __construct()
    {
        $this->psr6Cache = new FilesystemAdapter();
        $this->getLogin();
    }

    public function getLogin()
    {
        $this->connexion = new Instagram(new GuzzleHttp\Client());
        return $this->connexion;
    }

    public function getImages(int $numberOfImages)
    {
        return $this->connexion->getMediasByUserId('1463798983', $numberOfImages);
    }
}
