<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName("Продукт {$i}");
            $product->setFullname("Продукт {$i}. ГОСТ-" . random_int(1000, 5000));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
