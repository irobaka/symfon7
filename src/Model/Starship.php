<?php

declare(strict_types=1);

namespace App\Model;

final class Starship
{
    public function __construct(
        private(set) int $id,
        private(set) string $name,
        private(set) string $class,
        private(set) string $captain,
        private(set) StarshipStatus $status,
    ) {
    }

    public string $statusName {
        get => $this->status->value;
    }

    public string $statusImage {
        get => $this->status->statusImage();
    }
}
