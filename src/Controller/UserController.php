<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/complete', name: 'app_complete', methods: ['POST'])]
    public function complete(Request $request, EntityManagerInterface $em): Response
    {
        $data = $request->getPayload();

        if (!empty($data->get('username')) && !empty($data->get('fullname'))) {
            $user = $this->getUser(); // ici on récupère l'utilisateur actuel
            $user
                ->setUsername($data->get('username')) // on met à jour username
                ->setFullname($data->get('fullname')) // on met à jour fullname
            ;
            $em->persist($user); // on persiste l'utilisateur
            $em->flush(); // on save les modifications en bdd

            // redirection avec flash message
            $this->addFlash('success', 'Votre profil est complété');
        } else {
            $this->addFlash('error', 'Vous devez remplir tous les champs');
        }

        return $this->redirectToRoute('app_profile');
    }
}
