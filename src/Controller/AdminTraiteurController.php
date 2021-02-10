<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Services\YamlWrite;
use App\Repository\MenuRepository;
use App\Repository\TranslateRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/traiteur")
 */
class AdminTraiteurController extends AbstractController
{
    /**
     * @Route("/", name="admin_traiteur_index", methods={"GET"})
     */
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('admin/traiteur/index.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }
    /**
     * @Route("/new", name="admin_traiteur_new", methods={"GET","POST"})
     */
    public function new(Request $request, YamlWrite $yamlWrite): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menu);
            $entityManager->flush();
            $yamlWrite->menu2Yaml();

            return $this->redirectToRoute('admin_traiteur_index');
        }

        return $this->render('admin/traiteur/new.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/change", name="admin_traiteur_addToMenuWeek", methods={"GET"})
     */
    public function updateMenuWeek(Menu $menu): Response
    {
        if ($menu->getMenuOfWeek() === true) {
            $menu->setMenuOfWeek(false);
            $this->getDoctrine()->getManager()->flush();
        } else {
            $menu->setMenuOfWeek(true);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->RedirectToRoute('admin_traiteur_index');
    }

    /**
     * @Route("show/{id}", name="admin_traiteur_show", methods={"GET"})
     */
    public function show(Menu $menu): Response
    {
        return $this->render('admin/traiteur/show.html.twig', [
            'menu' => $menu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_traiteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Menu $menu, YamlWrite $yamlWrite): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $yamlWrite->menu2Yaml();

            return $this->redirectToRoute('admin_menu_index');
        }

        return $this->render('admin/traiteur/edit.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="admin_traiteur_delete", methods={"DELETE"})
     */
    public function delete(
        Request $request,
        Menu $menu,
        TranslateRepository $translateRepository,
        YamlWrite $yamlWrite
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $menu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $menuName = $menu->getName();
            $menuDescription = $menu->getDescription();
            $menuMore = $menu->getMore();
            $menuId = $menu->getId();
            $yamlKeys[0] = "$menuName.$menuId";
            $yamlKeys[1] = "$menuDescription.$menuId";
            $yamlKeys[2] = "$menuMore.$menuId";
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
            $entityManager->remove($menu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_traiteur_index');
    }
}
