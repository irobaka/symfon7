<?php

declare(strict_types=1);

namespace App\Model;

enum StarshipStatus: string
{
    case WAITING = 'waiting';
    case IN_PROGRESS = 'in progress';
    case COMPLETED = 'completed';

    public function statusImage(): string
    {
        return match ($this) {
            self::WAITING => 'images/status-waiting.png',
            self::IN_PROGRESS => 'images/status-in-progress.png',
            self::COMPLETED => 'images/status-completed.png',
        };
    }
}
