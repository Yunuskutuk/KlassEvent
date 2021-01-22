<?php

namespace App\Controller;

use App\Entity\Translate;
use App\Form\TranslateType;
use App\Repository\TranslateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Services\YamlWrite;

/**
 * @Route("/translate")
 */
class TranslateController extends AbstractController
{
    /**
     * @Route("/", name="translate_index", methods={"GET"})
     */
    public function index(TranslateRepository $translateRepository): Response
    {
        return $this->render('translate/index.html.twig', [
            'translates' => $translateRepository->findBy([], ['yamlKey' => 'asc'], null, null),
        ]);
    }

    /**
     * @Route("/new", name="translate_new", methods={"GET","POST"})
     */
    public function new(Request $request, YamlWrite $writeFr, YamlWrite $writeTrk): Response
    {
        $translate = new Translate();
        $form = $this->createForm(TranslateType::class, $translate);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($translate);
            $entityManager->flush();

            $writeFr->yamlWriteFrench();

            $writeTrk->yamlWriteTurkish();

            return $this->redirectToRoute('translate_index');
        }

        return $this->render('translate/new.html.twig', [
            'translate' => $translate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="translate_show", methods={"GET"})
     */
    public function show(Translate $translate): Response
    {
        return $this->render('translate/show.html.twig', [
            'translate' => $translate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="translate_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Translate $translate, YamlWrite $writeFr, YamlWrite $writeTrk): Response
    {
        $form = $this->createForm(TranslateType::class, $translate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $writeFr->yamlWriteFrench();
            $writeTrk->yamlWriteTurkish();

            return $this->redirectToRoute('translate_index');
        }

        return $this->render('translate/edit.html.twig', [
            'translate' => $translate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="translate_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Translate $translate, YamlWrite $writeFr, YamlWrite $writeTrk): Response
    {
        if ($this->isCsrfTokenValid('delete' . $translate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($translate);
            $entityManager->flush();
        }

        $writeFr->yamlWriteFrench();
        $writeTrk->yamlWriteTurkish();

        return $this->redirectToRoute('translate_index');
    }
}
