<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'product_list')]
    public function index(): Response
    {
        return $this->render('product_view.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
