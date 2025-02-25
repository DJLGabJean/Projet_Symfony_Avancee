<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Service\CSVExport;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'product_list')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product_view.html.twig', [
            'products' => $productRepository->findAllSortedByPriceDesc(),
        ]);
    }

    #[Route('/export/csv', name: 'export_csv')]
    public function exportCsv(CSVExport $csvExport): Response
    {
        return $csvExport->exportProducts();
    }
}
