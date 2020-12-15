<?php

namespace App\DataFixtures;

use App\Entity\Counterparty;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CounterpartyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = $manager->getRepository(User::class)->findOneBy(['username' => 'user']);

        if (is_null($user)) {
            return;
        }

        for ($i = 1; $i < 11; $i++) {
            $counterparty = new Counterparty();
            $counterparty->setName("Детский сад №{$i}");
            $counterparty->setFullname("МБДОУ Детский сад №{$i} города Азова");
            $counterparty->setUserId($user);
            $manager->persist($counterparty);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
