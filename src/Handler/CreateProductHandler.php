<?php

namespace App\Handler;

use App\Command\CreateProductCommand;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class CreateProductHandler
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(CreateProductCommand $command)
    {
        $product = new Product();
        $product->setCode($command->getCode());
        $product->setName($command->getName());
        $product->setType($command->getType());
        $product->setPrice($command->getPrice());

        $this->em->persist($product);
        $this->em->flush();
    }
}
