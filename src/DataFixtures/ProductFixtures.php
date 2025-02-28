<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'name' => 'Figurine All Might: Golden Age (Édition Exclusive)',
                'description' => 'Une figurine détaillée de All Might dans son âge d\'or, édition exclusive de First 4 Figures.',
                'price' => 99.99,
            ],
            [
                'name' => 'Figurine All Might: Casual Wear (Édition Exclusive)',
                'description' => 'Figurine représentant All Might en tenue décontractée, édition exclusive de First 4 Figures.',
                'price' => 99.99,
            ],
            [
                'name' => 'Figurine Izuku Midoriya (Édition Exclusive)',
                'description' => 'Figurine exclusive d\'Izuku Midoriya par First 4 Figures, capturant son énergie héroïque.',
                'price' => 144.99,
            ],
            [
                'name' => 'Figurine All Might: Silver Age (Édition Exclusive)',
                'description' => 'Représentation de All Might durant son "Silver Age", édition exclusive de First 4 Figures.',
                'price' => 99.99,
            ],
            [
                'name' => 'Figurine Izuku Midoriya (1/6 Résine Édition Exclusive)',
                'description' => 'Statue en résine à l\'échelle 1/6 d\'Izuku Midoriya, édition exclusive de First 4 Figures.',
                'price' => 549.99,
            ],
            [
                'name' => 'Figurine All Might: Symbol of Peace (1/8 Résine)',
                'description' => 'Statue en résine à l\'échelle 1/8 de All Might, symbolisant la paix, par First 4 Figures.',
                'price' => 269.99,
            ],
        ];

        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setDescription($productData['description']);
            $product->setPrice($productData['price']);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
