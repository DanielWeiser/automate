<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use App\Entity\ContractProduct;
use App\Entity\Counterparty;
use App\Entity\Orders;
use App\Entity\OrdersProduct;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrdersProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->findOneBy(['username' => 'user']);
        $counterparties = $manager->getRepository(Counterparty::class)->findBy(['user' => $user]);

        if (is_null($user) || is_null($counterparties)) {
            return;
        }

        foreach ($counterparties as $counterparty) {
            $contracts = $manager->getRepository(Contract::class)->findBy(['counterparty' => $counterparty]);

            foreach ($contracts as $contract) {
                $contractProducts = $manager->getRepository(ContractProduct::class)->findBy(['contract' => $contract]);
                $orders = $manager->getRepository(Orders::class)->findBy(['contract' => $contract]);

                foreach ($orders as $order) {
                    for ($i = 0; $i < random_int(1, count($contractProducts)); $i++) {
                        $contractProduct = $contractProducts[$i];

                        if (0 === (int)$contractProduct->getLeftovers()) {
                            continue;
                        }

                        $ordersProduct = new OrdersProduct();
                        $ordersProduct->setOrders($order);
                        $ordersProduct->setProduct($contractProduct->getProduct());
                        $quantity = random_int(1, $contractProduct->getLeftovers());
                        $ordersProduct->setQuantity($quantity);
                        $contractProduct->setLeftovers($contractProduct->getLeftovers() - $quantity);

                        $manager->persist($ordersProduct);
                        $manager->persist($contractProduct);
                    }
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OrdersFixtures::class,
        ];
    }
}
