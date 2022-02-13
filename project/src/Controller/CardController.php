<?php

namespace App\Controller;

use App\Entity\Card;
use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CardFormType;

class CardController extends AbstractController
{
    #[Route('/card/new', name: 'card', methods: ['GET','POST'])]
    public function index(Request $request, CardRepository $cardRepository, Card $card): Response
    {
        $form = $this->createForm(CardFormType::class, $card);
        $form->handleRequest($request);

        /*if ($form->isSubmitted() && $form->isValid()) {
            
            //dd($form->get('isAdmin')->getData());
            $cardRepository->setScore($cardRepository->getScore() + 1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cardRepository);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('default');
        }*/

        return $this->render('card/index.html.twig', [
            'cards' => $cardRepository->findByStatus('new')
            //'registrationForm' => $form->createView(),
        ]);
    }
}
