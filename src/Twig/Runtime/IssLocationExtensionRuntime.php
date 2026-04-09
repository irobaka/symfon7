<?php

namespace App\Twig\Runtime;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Extension\RuntimeExtensionInterface;

readonly class IssLocationExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private HttpClientInterface $client,
        private CacheInterface $issLocationPool,
        #[Autowire(param: 'iss_location_cache_ttl')]
        private int $issLocationCacheTtl,
        private string $issLocationCacheKey,
    ) {
    }

    public function getIssLocationData()
    {
        return $this->issLocationPool->get(
            $this->issLocationCacheKey,
            function (ItemInterface $item) {
                $item->expiresAfter($this->issLocationCacheTtl);
                $response = $this->client->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');

                return $response->toArray();
            });
    }
}
