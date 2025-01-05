<?php

namespace App\Models;

use PDO;

class PlayersTable extends AbstractTable
{

    protected string $table = 'players';//table that c ontains the players.

 
    protected PDO $pdo;


    public function __construct()
    {
        $this->pdo = new PDO( 'mysql:host=tic_tac_toe_test_db;port=3306;dbname=tic_tac_toe;charset=utf8mb4',
        'tic_tac_toe',
        'tic_tac_toe');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllPlayers(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getTableName(): string
    {
        return $this->table;
    }

    //adds new player to db
    public function createPlayer(string $name): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO players (name) VALUES (:name)');
        $stmt->execute(['name' => $name]);
        return (int)$this->pdo->lastInsertId();
    }

    //fetches all players, will use this for leaderboard, unused
    /*public function  getAllPlayers(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM players');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }*/

    public function getLeaders(int $gridSize): array
    {
        $stmt = $this->pdo->prepare("
            
                SELECT
                    name,
                    play_time_seconds,
                    grid_size
                FROM players
                WHERE
                    grid_size = :grid_size
            ");
            
        
        $stmt->execute([':grid_size' => $gridSize]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addRow(string $name, int $gridSize, int $playTimeSeconds, string $date): void
    {
        $stmt = $this->pdo->prepare("
            
                INSERT INTO players
                    (name, grid_size, play_time_seconds, ctime)
                VALUE
                    (:name, :grid_size, :play_time_seconds, :date)
            ");
            $stmt->execute([
                ':name' => $name,
                ':grid_size' => $gridSize,
                ':play_time_seconds' => $playTimeSeconds,
                ':date' => $date,
            ]);
        
    }
}
