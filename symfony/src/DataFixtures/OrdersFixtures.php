<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use App\Entity\Counterparty;
use App\Entity\Orders;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrdersFixtures extends Fixture implements DependentFixtureInterface
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
                for ($i = 0; $i < random_int(10, 100); $i++) {
                    $orders = new Orders();
                    $orders->setContract($contract);

                    $manager->persist($orders);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ContractFixtures::class,
        ];
    }
}
