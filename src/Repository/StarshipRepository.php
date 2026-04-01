<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Starship;
use App\Model\StarshipStatus;
use Psr\Log\LoggerInterface;

final class StarshipRepository
{
    public function __construct(
        private readonly LoggerInterface $logger,
    ) {
    }

    public function findAll(): array
    {
        $this->logger->info('Starships collection retrieved');

        return [
            new Starship(
                1,
                'USS LeafyCruiser (NCC-0001)',
                'Garden',
                'Jean-Luc Pickles',
                StarshipStatus::IN_PROGRESS
            ),
            new Starship(
                2,
                'USS Espresso (NCC-1234-C)',
                'Latte',
                'James T. Quick!',
                StarshipStatus::COMPLETED,
            ),
            new Starship(
                3,
                'USS Wanderlust (NCC-2024-W)',
                'Delta Tourist',
                'Kathryn Journeyway',
                StarshipStatus::WAITING,
            ),
        ];
    }

    public function find(int $id): ?Starship
    {
        foreach ($this->findAll() as $starship) {
            if ($starship->id === $id) {
                $this->logger->info('Starship retrieved', ['id' => $id]);

                return $starship;
            }
        }

        return null;
    }
}
