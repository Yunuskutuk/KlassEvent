<?php

namespace App\DataFixtures;

use App\Entity\Translate;
use App\Repository\TranslateRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class TranslateFixtures extends Fixture implements FixtureGroupInterface
{
    /**
     * @var mixed
     */
    private $translateRepository;

    public function __construct(TranslateRepository $translateRepository)
    {
        $this->translateRepository = $translateRepository;
    }

    public static function getGroups(): array
    {
        return ['group1'];
    }

    public function load(ObjectManager $manager)
    {
        // first step, extract datas from /translations/messages.xx.yaml
        $fileNameFR = "translations/messages.fr.yaml";
        $fileFR = fopen($fileNameFR, "r");
        $contentFR = fread($fileFR, filesize($fileNameFR));
        fclose($fileFR);

        $fileNameTRK = "translations/messages.trk.yaml";
        $fileTRK = fopen($fileNameTRK, "r");
        $contentTRK = fread($fileTRK, filesize($fileNameTRK));
        fclose($fileTRK);

        // ok, now, we have to put this two datas in two arrays
        $tempArrayFR = explode("\n", $contentFR);
        $arrayFR = [];
        foreach ($tempArrayFR as $value) {
            if ($value) {
                $data = explode(": ", $value);
                $actualKey = $data[0];
                $actualValue = $data[1];
                $arrayFR[$actualKey] = $actualValue;
            }
        }

        $tempArrayTRK = explode("\n", $contentTRK);
        $arrayTRK = [];
        foreach ($tempArrayTRK as $value) {
            if ($value) {
                $data = explode(": ", $value);
                $actualKey = $data[0];
                $actualValue = $data[1];
                $arrayTRK[$actualKey] = $actualValue;
            }
        }

        // now, we have two arrays with Key and french or turkish values
        // we'll put inside DB if it's not inside
        // to do that, first we take data in translate repository
        $translations = $this->translateRepository->findAll();
        foreach ($arrayFR as $yamlKey => $french) {
            $inside = false;
            foreach ($translations as $translation) {
                if ($translation->getYamlKey() == $yamlKey) {
                    $inside = true;
                }
            }
            if (!$inside) {
                $temp = $arrayTRK[$yamlKey];
                $row = new Translate();
                $row->setYamlKey($yamlKey)
                    ->setFrench($french)
                    ->setTurkish($temp);

                $manager->persist($row);
            }
        }
        $manager->flush();
    }
    // to update with this fixture -> $ symfony console d:f:l --group=group1 --append
}
