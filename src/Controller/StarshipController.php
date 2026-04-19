<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Starship;
use App\Repository\StarshipPartRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/starships', name: 'starships.')]
final class StarshipController extends AbstractController
{
    #[Route('/{slug}', name: 'show')]
    public function show(
        #[MapEntity(mapping: ['slug' => 'slug'])]
        Starship $starship,
    ): Response {
        return $this->render('starship/show.html.twig', [
            'ship' => $starship,
        ]);
    }
}
