<?php

namespace App\DataFixtures;

use App\Entity\StarshipStatus;
use App\Factory\StarshipFactory;
use App\Factory\StarshipPartFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        StarshipFactory::createOne([
            'name' => 'USS LeafyCruiser (NCC-0001)',
            'captain' => 'Jean-Luc Pickles',
            'class' => 'Garden',
            'status' => StarshipStatus::IN_PROGRESS,
            'arrivedAt' => new \DateTimeImmutable('-1 day'),
        ]);

        StarshipFactory::createOne([
            'name' => 'USS Espresso (NCC-1234-C)',
            'captain' => 'James T. Quick!',
            'class' => 'Latte',
            'status' => StarshipStatus::COMPLETED,
            'arrivedAt' => new \DateTimeImmutable('-1 week'),
        ]);

        StarshipFactory::createOne([
            'name' => 'USS Wanderlust (NCC-2024-W)',
            'captain' => 'Kathryn Journeyway',
            'class' => 'Delta Tourist',
            'status' => StarshipStatus::WAITING,
            'arrivedAt' => new \DateTimeImmutable('-1 month'),
        ]);

        StarshipFactory::createMany(20);

        StarshipPartFactory::createMany(50);
    }
}
