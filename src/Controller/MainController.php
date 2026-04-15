<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function homepage(
        StarshipRepository $repository,
    ): Response {
        return $this->render('main/homepage.html.twig', [
            'ships' => $repository->findIncomplete(),
            'myShip' => $repository->findMyShip(),
        ]);
    }
}
