<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\PresupuestoFactory;

class PresupuestoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        PresupuestoFactory::createMany(5);
        $manager->flush();
    }
}
