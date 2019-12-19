<?php

namespace App\Controller\Admin;

use App\Entity\NewOption;
use App\Form\NewOptionType;
use App\Repository\NewOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/newoption")
 */
class NewOptionController extends AbstractController
{
    /**
     * @Route("/", name="newoption_index", methods={"GET"})
     */
    public function index(NewOptionRepository $newOptionRepository): Response
    {
        return $this->render('admin/new_option/index.html.twig', [
            'new_options' => $newOptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="newoption_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newOption = new NewOption();
        $form = $this->createForm(NewOptionType::class, $newOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newOption);
            $entityManager->flush();

            return $this->redirectToRoute('newoption_index');
        }

        return $this->render('admin/new_option/new.html.twig', [
            'new_option' => $newOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="newoption_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NewOption $newOption): Response
    {
        $form = $this->createForm(NewOptionType::class, $newOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('newoption_index', [
                'id' => $newOption->getId(),
            ]);
        }

        return $this->render('admin/new_option/edit.html.twig', [
            'new_option' => $newOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="newoption_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NewOption $newOption): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newOption->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('newoption_index');
    }
}
