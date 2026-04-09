<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\IssLocationExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class IssLocationExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_iss_location_data', [IssLocationExtensionRuntime::class, 'getIssLocationData']),
        ];
    }
}
