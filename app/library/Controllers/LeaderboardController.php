<?php

namespace App\Controllers;

use App\Models\PlayersTable;
//use App\Views\AbstractView;
use App\Views\LeaderboardView;

class LeaderboardController implements ControllerInterface
{

    public function indexAction(): LeaderboardView
    {
        //functions for leaderboard
        $view = new LeaderboardView();

        $playersTable = new PlayersTable();
        $view->players = $playersTable->getTopPlayers();
        $view->totalPlayers = $playersTable->getTotalPlayers();




        return $view;
    }








}
