<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function homepage(
        StarshipRepository $starshipRepository,
        HttpClientInterface $client,
        CacheInterface $issLocationPool,
        #[Autowire(param: 'iss_location_cache_ttl')]
        int $issLocationCacheTtl,
        string $issLocationCacheKey,
    ): Response {
        $ships = $starshipRepository->findAll();
        $myShip = $ships[array_rand($ships)];

        $issData = $issLocationPool->get(
            $issLocationCacheKey,
            function (ItemInterface $item) use ($client, $issLocationCacheTtl) {
                $item->expiresAfter($issLocationCacheTtl);
                $response = $client->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');

                return $response->toArray();
            });

        return $this->render('main/homepage.html.twig', [
            'ships' => $ships,
            'myShip' => $myShip,
            'issData' => $issData,
        ]);
    }
}
