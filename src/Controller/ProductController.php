<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProductRepository;
use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use App\Service\CSVExport;
use Doctrine\ORM\EntityManagerInterface;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'product_list')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('product_view.html.twig', [
            'products' => $productRepository->findAllSortedByPriceDesc(),
            'newId' => $productRepository->getNewId()
        ]);
    }

    #[Route('/admin/product/add/{newId}', name: 'admin_product_add', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('PRODUCT_CREATE');

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_list');
        }

        return $this->render('admin/product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/product/edit/{id}', name: 'admin_product_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Product $product, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('PRODUCT_EDIT', $product);

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('product_list');
        }

        return $this->render('admin/product/edit.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);
    }

    #[Route('/admin/product/edit/{id}', name: 'admin_product_delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Product $product, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('PRODUCT_DELETE', $product);

        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_list');
    }

    #[Route('/export/csv', name: 'export_csv')]
    public function exportCsv(CSVExport $csvExport): Response
    {
        return $csvExport->exportProducts();
    }
}
