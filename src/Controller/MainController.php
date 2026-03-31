<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController
{
    #[Route('/', name: 'main')]
    public function homepage(): Response
    {
        return new Response(
            '<strong>Starshop</strong>: your monopoly-busting option for Starhip parts!'
        );
    }
}
