<?php

namespace App\Service;

use App\Repository\ProductRepository;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\Response;

class CSVExport
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function exportProducts(): Response
    {
        $products = $this->productRepository->findAll();
        $csv = Writer::createFromString('');
        
        // En-tête CSV
        $csv->insertOne(['Nom', 'Description', 'Prix']);

        // Ajout des données
        foreach ($products as $product) {
            $csv->insertOne([$product->getName(), $product->getDescription(), $product->getPrice()]);
        }

        $response = new Response($csv->toString());
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="products.csv"');

        return $response;
    }
}
