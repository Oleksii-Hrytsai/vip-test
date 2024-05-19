<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $types = ['type-1', 'type-2', 'type-3'];

        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $product->setCode($faker->numberBetween(1, 10));
            $product->setName($faker->name());
            $product->setType($faker->randomElement($types));
            $product->setPrice($faker->numberBetween(100, 1000));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
