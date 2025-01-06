<?php

namespace App\Views;

class LeaderboardView extends AbstractView
{
    /** @var array[][] */
    public array $players = [];
    //had to add this public int due to warning about deprecated dynamic properties, apparently dynamic properties cannot be used in version php 8.2 and newer.
    public int $totalPlayers = 0;

    public function __construct()
    {
        $this->setTitle("Leaderboard");
    }

    public function render(): void
    {
        include __DIR__ . '/leaderboard.php';
    }
}
