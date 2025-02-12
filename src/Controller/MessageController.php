<?php

namespace App\Controller;

use App\Repository\DiscussionRepository;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class MessageController extends AbstractController
{
    public function __construct(
        private DiscussionRepository $ds,
        private MessageRepository $ms,
    ){}

    #[Route('/messages/{id}', name: 'app_message', methods: ['GET', 'POST'])]
    public function show($id): Response
    {
        $discussion = $this->ds->find($id);
        return $this->render('message/show.html.twig', [
            'messages' => $discussion->getMessages(),
        ]);
    }
}
