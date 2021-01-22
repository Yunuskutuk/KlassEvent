<?php

namespace App\Services;

use App\Repository\TranslateRepository;

class YamlWrite
{
    /**
     * @var TranslateRepository
     */
    private $translateRepository;

    public function __construct(TranslateRepository $translateRepository)
    {
        $this->translateRepository = $translateRepository;
    }

    public function yamlWriteFrench(): void
    {
        $translate = $this->translateRepository->findBy([], ['yamlKey' => 'asc'], null, null);

        $file = fopen("../translations/messages.fr.yaml", "w+") or die("File doesnt exist");

        if ($file != false) {
            foreach ($translate as $objet) {
                $key = $objet->getYamlKey();
                $value = $objet->getFrench();
                fwrite($file, "$key: $value\n");
            }

            fclose($file);
        }
    }


    public function yamlWriteTurkish(): void
    {
            $translate = $this->translateRepository->findBy([], ['yamlKey' => 'asc'], null, null);
            $file = fopen("../translations/messages.trk.yaml", "w") or die("File doesnt exist");

        if ($file != false) {
            foreach ($translate as $objet) {
                $key = $objet->getYamlKey();
                $value = $objet->getTurkish();
                fwrite($file, "$key: $value\n");
            }
            fclose($file);
        }
    }
}
