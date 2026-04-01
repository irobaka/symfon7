<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/starships', name: 'api.starships.')]
final class StarshipApiController extends AbstractController
{
    #[Route('', name: 'all', methods: ['GET'])]
    public function getCollection(
        StarshipRepository $repository,
    ): Response {
        return $this->json($repository->findAll());
    }

    #[Route('/{id<\d+>}', name: 'one', methods: ['GET'])]
    public function get(int $id, StarshipRepository $repository): Response
    {
        $starship = $repository->find($id);

        if (!$starship) {
            throw $this->createNotFoundException('Starship not found');
        }

        return $this->json($starship);
    }
}
