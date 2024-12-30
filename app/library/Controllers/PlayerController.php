<?php

namespace App\Controllers;

use App\Views\JsonView;
use App\Models\PlayersTable;

// needed to create a new player controller in order to create new players, previously it only used "player".
class PlayerController implements ControllerInterface
{
    public function createAction(): JsonView
    {
        $playerName = $_POST['player_name'] ?? null;

        if (!$playerName) {
            return new JsonView(['success' => false, 'error' => 'Player name is required.']);
        }

        $playersTable = new PlayersTable();
        $playerId = $playersTable->createPlayer($playerName);

        return new JsonView(['success' => true, 'player_id' => $playerId, 'player_name' => $playerName]);
    }

    public function listAction(): JsonView
    {
        $playersTable = new PlayersTable();
        $players = $playersTable->getAllPlayers();

        return new JsonView($players);
    }
}
