<?php

namespace App\Controller;

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
    public function complete(Request $request): Response
    {
        $username = $request->request->get('username');
        $fullname = $request->request->get('fullname');

        if (!empty($username) && !empty($fullname)) {

        }

        // Redirect avec flash message
        $this->addFlash('success', 'Votre profile est complété');
        return $this->redirectToRoute('app_profile');
    }
}
