<?php

namespace App\Services;

use InstagramScraper\Instagram;
use GuzzleHttp;
use Symfony\Component\Cache\Adapter\Psr16Adapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

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
     * @return \InstagramScraper\Model\Media[]
     */
    public function getImages(int $numberOfImages): array
    {
        return $this->connexion->getMediasByUserId(1463798983, $numberOfImages);
    }
}
