<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use App\Entity\Counterparty;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContractFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->findOneBy(['username' => 'user']);

        if (is_null($user)) {
            return;
        }

        $counterparties = $manager->getRepository(Counterparty::class)->findBy(['user_id' => $user]);

        foreach ($counterparties as $counterparty) {
            for ($i = 0; $i < random_int(1, 4); $i++) {
                $contract = new Contract();

                $number = random_int(1, 1000);
                $contract->setNumber($number);

                $date = new \DateTime();
                $date->setTimestamp(random_int(1572033681,1608154865));
                $contract->setDate($date);

                $contract->setDescription("Контракт №{$number} от {$date->format('Y-m-d')}");
                $contract->setCounterpartyId($counterparty);
                $manager->persist($contract);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CounterpartyFixtures::class,
        ];
    }
}
