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

    
    //fetches top players based on grid and playtime
    public function getTopPlayers(): array
{
    $stmt = $this->pdo->query("
        SELECT * 
        FROM players 
        ORDER BY grid_size DESC, play_time_seconds DESC 
        LIMIT 20
    ");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    //retrieves total amount of players
    public function getTotalPlayers(): int
{
    $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM players");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int)$result['total'];
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

}
