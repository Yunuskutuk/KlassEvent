<?php

namespace App\Services;

use InstagramScraper\Instagram;
use GuzzleHttp;
use Symfony\Component\Cache\Adapter\Psr16Adapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;

class InstagramServices
{

    /**
     * @var Instagram
     */
    private $connexion;

    /**
     * @var FilesystemAdapter
     */
    private $psr6Cache;

    public function __construct()
    {
        $this->psr6Cache = new FilesystemAdapter();
        $this->getLogin();
    }

    public function getLogin(): void
    {
        $this->connexion = new Instagram(new GuzzleHttp\Client());
    }

    /**
     * @param int $numberOfImages
     * @return Instagram
     */
    public function getImages(int $numberOfImages): Instagram
    {
        return $this->connexion->getMediasByUserId('1463798983', $numberOfImages);
    }
}
