<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClientController extends AbstractController
{
    #[Route('/client', name: 'admin_client_list')]
    public function index(): Response
    {
        return $this->render('admin/client/view.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}
