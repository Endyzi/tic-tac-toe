<?php

namespace App\Controllers;

use App\Models\PlayersTable;
//use App\Views\AbstractView;
use App\Views\LeaderboardView;

class LeaderboardController implements ControllerInterface
{

    public function indexAction(): LeaderboardView {

        $view = new LeaderboardView();

        $playersTable = new PlayersTable();
        $view->players = $playersTable->getTopPlayers();
        $view->totalPlayers = $playersTable->getTotalPlayers();

        //$players = (new PlayersTable())->getAllPlayers();
       
        //$view->players = $players;
        return $view;
    }
    /*public function indexAction(): AbstractView
    {
        $view = new LeaderboardView();

        // Todo: redo this crap!
        $players = (new PlayersTable())->getLeaders(10);
        $view->players = $players;

        return $view;
    }*/


/*senaste
    public function getAllPlayersAction(): AbstractView {
        $view = new LeaderboardView(); // Du kan använda samma vy
        $players = (new PlayersTable())->getAllPlayers();
        $view->players = $players; // Tilldela spelarna till vyn
        return $view;
    }*/


    

}
