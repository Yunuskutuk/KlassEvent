<?php

namespace App\Services;

use App\Entity\Translate;
use App\Repository\MenuRepository;
use App\Repository\EventRepository;
use App\Repository\OptionRepository;
use App\Repository\PictureRepository;
use App\Repository\ServiceRepository;
use App\Repository\TranslateRepository;
use Doctrine\ORM\EntityManagerInterface;

class YamlWrite
{
    /**
     * @var TranslateRepository
     */
    private $translateRepository;

    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * @var MenuRepository
     */
    private $menuRepository;

    /**
     * @var OptionRepository
     */
    private $optionRepository;

    /**
     * @var PictureRepository
     */
    private $pictureRepository;

    /**
     * @var ServiceRepository
     */
    private $serviceRepository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(
        TranslateRepository $translateRepository,
        EventRepository $eventRepository,
        MenuRepository $menuRepository,
        OptionRepository $optionRepository,
        PictureRepository $pictureRepository,
        ServiceRepository $serviceRepository,
        EntityManagerInterface $manager
    ) {
        $this->translateRepository = $translateRepository;
        $this->eventRepository = $eventRepository;
        $this->menuRepository = $menuRepository;
        $this->optionRepository = $optionRepository;
        $this->pictureRepository = $pictureRepository;
        $this->serviceRepository = $serviceRepository;
        $this->manager = $manager;
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

    public function event2Yaml(): void
    {
        // first step, take all avents and all translations
        $events = $this->eventRepository->findAll();
        $translations = $this->translateRepository->findAll();
        // now we have to compare that and put inside translate the missing Keys
        foreach ($events as $event) {
            $inside = false;
            $theType = $event->getType();
            $theId = $event->getId();
            $yamlKey = "$theType.$theId";
            foreach ($translations as $translate) {
                if ($yamlKey == $translate->getYamlKey()) {
                    $inside = true;
                }
            }
            // if the yamlKey is not already inside we input it
            if (!$inside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theType.$theId")
                    ->setFrench("$theType")
                    ->setTurkish("$theType");

                $this->manager->persist($newTranslate);
            }
        }
        // well, now we can whrite all that in DB
        $this->manager->flush();
        // and update messages.fr.yaml and messages.trk.yaml
        $this->yamlWriteFrench();
        $this->yamlWriteTurkish();
    }

    public function option2Yaml(): void
    {
        // to see how it's working look in event2Yaml()
        $options = $this->optionRepository->findAll();
        $translations = $this->translateRepository->findAll();
        foreach ($options as $option) {
            $inside = false;
            $theName = $option->getName();
            $theId = $option->getId();
            $yamlKey = "$theName.$theId";
            foreach ($translations as $translate) {
                if ($yamlKey == $translate->getYamlKey()) {
                    $inside = true;
                }
            }
            if (!$inside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theName.$theId")
                    ->setFrench("$theName")
                    ->setTurkish("$theName");
                $this->manager->persist($newTranslate);
            }
            // we do the same for description
            $inside = false;
            $theDescription = $option->getDescription();
            $theId = $option->getId();
            $$yamlKey = "$theDescription.$theId";
            foreach ($translations as $translate) {
                if ($yamlKey == $translate->getYamlKey()) {
                    $inside = true;
                }
            }
            if (!$inside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theDescription.$theId")
                    ->setFrench("$theDescription")
                    ->setTurkish("$theDescription");
                $this->manager->persist($newTranslate);
            }
        }
        $this->manager->flush();
        $this->yamlWriteFrench();
        $this->yamlWriteTurkish();
    }

    public function picture2Yaml(): void
    {
        // to see how it's working look in event2Yaml()
        $pictures = $this->pictureRepository->findAll();
        $translations = $this->translateRepository->findAll();
        foreach ($pictures as $picture) {
            $inside = false;
            $theDescription = $picture->getDescription();
            $theId = $picture->getId();
            $yamlKey = "$theDescription.$theId";
            foreach ($translations as $translate) {
                if ($yamlKey == $translate->getYamlKey()) {
                    $inside = true;
                }
            }
            if (!$inside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theDescription.$theId")
                    ->setFrench("$theDescription")
                    ->setTurkish("$theDescription");

                $this->manager->persist($newTranslate);
            }
        }
        $this->manager->flush();
        $this->yamlWriteFrench();
        $this->yamlWriteTurkish();
    }

    public function service2Yaml(): void
    {
        // to see how it's working look in event2Yaml()
        $services = $this->serviceRepository->findAll();
        $translations = $this->translateRepository->findAll();
        foreach ($services as $service) {
            $inside = false;
            $theDescription = $service->getDescription();
            $theId = $service->getId();
            $yamlKey = "$theDescription.$theId";
            foreach ($translations as $translate) {
                if ($yamlKey == $translate->getYamlKey()) {
                    $inside = true;
                }
            }
            if (!$inside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theDescription.$theId")
                    ->setFrench("$theDescription")
                    ->setTurkish("$theDescription");

                $this->manager->persist($newTranslate);
            }
            // the same for title
            $inside = false;
            $theTitle = $service->getTitle();
            $theId = $service->getId();
            $yamlKey = "$theTitle.$theId";
            foreach ($translations as $translate) {
                if ($yamlKey == $translate->getYamlKey()) {
                    $inside = true;
                }
            }
            if (!$inside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theTitle.$theId")
                    ->setFrench("$theTitle")
                    ->setTurkish("$theTitle");

                $this->manager->persist($newTranslate);
            }
        }
        $this->manager->flush();
        $this->yamlWriteFrench();
        $this->yamlWriteTurkish();
    }

    public function menu2Yaml(): void
    {
        // to see how it's working look in event2Yaml()
        // but for this one, we do the 3 in one time
        $menus = $this->menuRepository->findAll();
        $translations = $this->translateRepository->findAll();
        foreach ($menus as $menu) {
            $nameInside = false;
            $theName = $menu->getName();
            $descriptioInside = false;
            $theDescription = $menu->getDescription();
            $moreInside = false;
            $theMore = $menu->getMore();
            $theId = $menu->getId();
            $yamlKey1 = "$theName.$theId";
            $yamlKey2 = "$theDescription.$theId";
            $yamlKey3 = "$theMore.$theId";
            foreach ($translations as $translate) {
                if ($yamlKey1 == $translate->getYamlKey()) {
                    $nameInside = true;
                }
                if ($yamlKey2 == $translate->getYamlKey()) {
                    $descriptioInside = true;
                }
                if ($yamlKey3 == $translate->getYamlKey()) {
                    $moreInside = true;
                }
            }
            if (!$nameInside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theName.$theId")
                    ->setFrench("$theName")
                    ->setTurkish("$theName");
                $this->manager->persist($newTranslate);
            }
            if (!$descriptioInside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theDescription.$theId")
                    ->setFrench("$theDescription")
                    ->setTurkish("$theDescription");
                $this->manager->persist($newTranslate);
            }
            if (!$moreInside) {
                $newTranslate = new Translate();
                $newTranslate
                    ->setYamlKey("$theMore.$theId")
                    ->setFrench("$theMore")
                    ->setTurkish("$theMore");
                $this->manager->persist($newTranslate);
            }
        }
        $this->manager->flush();
        $this->yamlWriteFrench();
        $this->yamlWriteTurkish();
    }
}
