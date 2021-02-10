<?php

namespace App\Controller;

use App\Entity\Option;
use App\Form\OptionType;
use App\Services\YamlWrite;
use App\Repository\OptionRepository;
use App\Repository\TranslateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/option")
 */
class OptionController extends AbstractController
{
    /**
     * @Route("/", name="admin_option_index", methods={"GET"})
     */
    public function index(OptionRepository $optionRepository): Response
    {
        return $this->render('admin/option/index.html.twig', [
            'options' => $optionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_option_new", methods={"GET","POST"})
     */
    public function new(Request $request, YamlWrite $yamlWrite): Response
    {
        $option = new Option();
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($option);
            $entityManager->flush();
            $yamlWrite->option2Yaml();

            return $this->redirectToRoute('admin_option_index');
        }

        return $this->render('admin/option/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_option_show", methods={"GET"})
     */
    public function show(Option $option): Response
    {
        return $this->render('admin/option/show.html.twig', [
            'option' => $option,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_option_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Option $option, YamlWrite $yamlWrite): Response
    {
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $yamlWrite->option2Yaml();

            return $this->redirectToRoute('admin_option_index');
        }

        return $this->render('admin/option/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_option_delete", methods={"DELETE"})
     */
    public function delete(
        Request $request,
        Option $option,
        TranslateRepository $translateRepository,
        YamlWrite $yamlWrite
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $option->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $optionName = $option->getName();
            $optionDescription = $option->getDescription();
            $optionId = $option->getId();
            $yamlKeys[0] = "$optionName.$optionId";
            $yamlKeys[1] = "$optionDescription.$optionId";
            foreach ($yamlKeys as $yamlKey) {
                $translate = $translateRepository->findOneBy([
                    'yamlKey' => $yamlKey
                ]);
                if ($translate) {
                    $entityManager->remove($translate);
                    $entityManager->flush();
                    $yamlWrite->event2Yaml();
                }
            }
            $entityManager->remove($option);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_option_index');
    }
}
