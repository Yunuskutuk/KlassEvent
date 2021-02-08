<?php

namespace App\Controller;

use App\Entity\MenuPicture;
use App\Form\MenuPictureType;
use App\Services\YamlWrite;
use App\Repository\MenuPictureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/menupicture")
 */
class MenuPictureController extends AbstractController
{
    /**
     * @Route("/", name="admin_menupicture_index", methods={"GET"})
     */
    public function index(MenuPictureRepository $menupictureRepository): Response
    {
        return $this->render('admin/menuPicture/index.html.twig', [
            'pictures' => $menupictureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_menupicture_new", methods={"GET","POST"})
     */
    public function new(Request $request, YamlWrite $yamlWrite): Response
    {
        $picture = new MenuPicture();
        $form = $this->createForm(MenuPictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();
            $yamlWrite->picture2Yaml();

            return $this->redirectToRoute('admin_menupicture_index');
        }

        return $this->render('admin/menuPicture/new.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_menupicture_show", methods={"GET"})
     */
    public function show(MenuPicture $picture): Response
    {
        return $this->render('admin/menuPicture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_menupicture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MenuPicture $picture, YamlWrite $yamlWrite): Response
    {
        $form = $this->createForm(MenuPictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $yamlWrite->picture2Yaml();

            return $this->redirectToRoute('admin_menupicture_index');
        }

        dump($picture);
        return $this->render('admin/menuPicture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_menupicture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MenuPicture $picture): Response
    {

        dump($picture);
        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_menupicture_index');
    }
}
