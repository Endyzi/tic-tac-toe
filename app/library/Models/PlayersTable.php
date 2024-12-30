<?php

namespace App\Models;

use PDO;

class PlayersTable extends AbstractTable
{


    private PDO $pdo;


    public function __construct()
    {
        $this->pdo = new PDO('mysql:host:localhost;dbname=tic_tac_toe', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    protected function getTableName(): string
    {
        return 'players';
    }

    //adds new player to db
    public function createPlayer(string $name): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO players (name) VALUES (:name)');
        $stmt->execute(['name' => $name]);
        return (int)$this->pdo->lastInsertId();
    }

    //fetches all players, will use this for leaderboard
    public function  getAllPlayers(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM players');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLeaders(int $gridSize): array
    {
        return $this->executeSql(
            "
                SELECT
                    name,
                    play_time_seconds,
                    grid_size
                FROM players
                WHERE
                    grid_size = :grid_size
            ",
            [
                ':grid_size' => $gridSize,
            ]
        );
    }

    public function addRow(string $name, int $gridSize, int $playTimeSeconds, string $date): void
    {
        $this->executeSql(
            "
                INSERT INTO players
                    (name, grid_size, play_time_seconds, ctime)
                VALUE
                    (:name, :grid_size, :play_time_seconds, :date)
            ",
            [
                ':name' => $name,
                ':grid_size' => $gridSize,
                ':play_time_seconds' => $playTimeSeconds,
                ':date' => $date,
            ]
        );
    }
}
