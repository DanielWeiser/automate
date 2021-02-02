<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use App\Entity\ContractProduct;
use App\Entity\Counterparty;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContractProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->findOneBy(['username' => 'user']);
        $counterparties = $manager->getRepository(Counterparty::class)->findBy(['user' => $user]);
        $products = $manager->getRepository(Product::class)->findAll();

        if (is_null($user) || is_null($counterparties) || is_null($products)) {
            return;
        }

        foreach ($counterparties as $counterparty) {
            $contracts = $manager->getRepository(Contract::class)->findBy(['counterparty' => $counterparty]);

            foreach ($contracts as $contract) {
                for ($i = 0; $i < random_int(2, count($products)); $i++) {
                    $contractProduct = new ContractProduct();
                    $contractProduct->setContract($contract);
                    $contractProduct->setProduct($products[$i]);
                    $contractProduct->setPrice(random_int(50, 2000));

                    $quantity = random_int(10, 1000);
                    $contractProduct->setLeftovers($quantity);
                    $contractProduct->setQuantity($quantity);

                    $manager->persist($contractProduct);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ContractFixtures::class,
            ProductFixtures::class,
        ];
    }
}
