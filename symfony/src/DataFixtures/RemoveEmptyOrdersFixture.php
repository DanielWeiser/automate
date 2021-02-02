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

class RemoveEmptyOrdersFixture extends Fixture implements DependentFixtureInterface
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
                $orders = $manager->getRepository(Orders::class)->findBy(['contract' => $contract]);

                foreach ($orders as $order) {
                    $ordersProduct = $manager->getRepository(OrdersProduct::class)->findBy(['orders' => $order]);

                    if (empty($ordersProduct)) {
                        $manager->remove($order);
                    }
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            OrdersProductFixtures::class,
        ];
    }
}
