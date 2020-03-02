<?php

namespace App\Controller;

use App\Entity\Choose;
use App\Entity\User;
use App\Form\ChooseType;
use App\Repository\ChooseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/choose")
 */
class ChooseController extends AbstractController
{
    /**
     * @Route("/", name="choose_index")
     */
    public function index(ChooseRepository $chooseRepository): Response
    {
        dump($chooseRepository->findAll());

        return $this->render('choose/index.html.twig', [
            'chooses' => $chooseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="choose_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $choose = new Choose();
        $form = $this->createForm(ChooseType::class, $choose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($choose);
            $entityManager->flush();

            return $this->redirectToRoute('choose_index');
        }

        return $this->render('choose/new.html.twig', [
            'choose' => $choose,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/add", name="choose_add", methods={"GET","POST"})
     */
    public function add(Request $request, User $user, ChooseRepository $chooseRepository): Response
    {
        $choose = new Choose();

        $choose->setUser($user);
        $form = $this->createForm(ChooseType::class, $choose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($choose);
            $entityManager->flush();

            return $this->redirectToRoute('choose_index');
        }

        return $this->render('choose/new.html.twig', [
            'user' => $user,
            'choose' => $choose,
            'form' => $form->createView(),
            'debugs' => $chooseRepository->findBy(['user' => $user])
        ]);
    }
}
