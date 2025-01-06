<?php

namespace App\Controllers;

use App\GameLogic;
use App\Views\IndexView;
use App\Views\AbstractView;
use App\Views\JsonView;
use App\Models\PlayersTable;

class IndexController implements ControllerInterface
{

    private PlayersTable $playersTable;

    public function __construct()
    {
        $this->playersTable = new PlayersTable();
    }


    //added check to get current player
    public function indexAction(): AbstractView
    {
        $gridSize = $this->getGridSize();
        $view = new IndexView();
        $view->gridSize = $gridSize;

         if (isset($_SESSION['current_player_id'])) {
        $playersTable = new \App\Models\PlayersTable();
        $view->currentPlayer = $playersTable->getPlayerById($_SESSION['current_player_id']);
    }

        return $view;
    }

    private function getGridSize(): int
    {
        // Simple validation
        $gridSize = intval($_GET['grid_size'] ?? 3);
        if ($gridSize < 3 || $gridSize > 50) {
            $gridSize = 3;
        }
        return $gridSize;
    }

    //new function to get current player
    public function getCurrentPlayer(): ?array
    {
        session_start();
        $playerId = $_SESSION['player_id'] ?? null;

        if ($playerId) {
            return $this->playersTable->getPlayerById($playerId);
        }
        return null;
    }

    public function createPlayerAction(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['player_name'])) {
            $playerName = trim($_POST['player_name']);

            if ($playerName !== '') {
                $playersTable = new \App\Models\PlayersTable();
                $playerId = $playersTable->createPlayer($playerName);

                // saaving player in a session to keep active, 
                $_SESSION['current_player_id'] = $playerId;

                // redirect , to view, i will maybe add error messages.
                header('Location: /');
                exit;
            }
        }
    }

    //get total players from db to be used to view in frontend, this only shows nr of players will remove later
    public function getTotalPlayersAction(): AbstractView
    {
        $playersTable = new \App\Models\PlayersTable();
        $totalPlayers = $playersTable->getTotalPlayers();

        $view = new JsonView();
        $view->data = ['totalPlayers' => $totalPlayers];
        return $view;
    }


    //  //function to retrive all players,  to be viewed in frontend after player has won
    public function getAllPlayersAction(): AbstractView
    {
        $playersTable = new \App\Models\PlayersTable();
        $allPlayers = $playersTable->getAllPlayers();

        $view = new \App\Views\JsonView();
        $view->data = ['players' => $allPlayers];
        return $view;
    }


    /**
     * It is used in Ajax requests.
     * @noinspection PhpUnused
     */
    public function opponentsTurnAction(): AbstractView
    {
        // Todo: Ask on StakeOverflow if it's good enough.
        $request_json = file_get_contents('php://input');
        $request = json_decode($request_json, true);

        $matrix = $request['matrix'] ?? [];

        $gameLogic = new GameLogic($matrix);

        $is_game_over = $gameLogic->isGameOver();
        $is_player_win = $gameLogic->doWeHaveWinner();
        $is_computer_win = false;
        $row = 0;
        $col = 0;
        if (!$is_player_win && $gameLogic->isFreeCellsLeft()) {
            list($row, $col) = $gameLogic->findBestMove();
            $gameLogic->setComputersMove($row, $col);
            $is_game_over = $gameLogic->isGameOver();
            $is_computer_win = $gameLogic->doWeHaveWinner();
        }

        $view = new JsonView();
        $view->data = [
            'is_game_over' => $is_game_over,
            'is_player_win' => $is_player_win,
            'is_computer_win' => $is_computer_win,
            'row' => $row,
            'col' => $col,
        ];
        return $view;
    }


}
