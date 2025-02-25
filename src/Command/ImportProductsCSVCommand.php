<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductRepository;
use App\Entity\Product;

#[AsCommand(
    name: 'app:import-products-csv',
    description: 'Add a short description for your command',
)]
class ImportProductsCSVCommand extends Command
{
private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Importe une liste de produits depuis un fichier CSV.')
            ->addArgument('filePath', InputArgument::REQUIRED, 'Chemin vers le fichier CSV à importer');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = $input->getArgument('filePath');

        if (!file_exists($filePath)) {
            $io->error("Le fichier '$filePath' est introuvable !");
            return Command::FAILURE;
        }

        try {
            $csv = Reader::createFromPath($filePath, 'r');
            $csv->setHeaderOffset(0); // Définir la première ligne comme en-tête

            $count = 0;
            foreach ($csv as $row) {
                if (!isset($row['name'], $row['description'], $row['price'])) {
                    $io->error("Le fichier CSV doit contenir les colonnes : name, description, price.");
                    return Command::FAILURE;
                }

                $product = new Product();
                $product->setName($row['name']);
                $product->setDescription($row['description']);
                $product->setPrice((float) $row['price']);

                $this->entityManager->persist($product);
                $count++;
            }

            $this->entityManager->flush();
            $io->success("$count produits importés avec succès !");
            return Command::SUCCESS;

        } catch (\Exception $e) {
            $io->error("Erreur lors de l'importation : " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
