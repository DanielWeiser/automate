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
            $counterparty->setInn(random_int(6110039640, 6140039640));
            $counterparty->setKpp(random_int(611001001, 614001001));
            $counterparty->setOkpo(random_int(21162144, 24162144));
            $counterparty->setOgrn(random_int(1116188002720, 1136188002720));
            $counterparty->setAddress(random_int(346780, 646780) . ", Ростовская обл, Азов г, Петровский пер, {$i}");
            $counterparty->setUser($user);
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
