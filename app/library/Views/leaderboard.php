<?php

/**
 * @var \App\Views\LeaderboardView $this
 * @see \App\Controllers\IndexController::chartAjaxAction()
 */

?>

<div class="row content-container col-xs-12">
<!-- displays total number of players from the leaderboardcontroller function-->   
<p>Total number of Players: <?= htmlspecialchars($this->totalPlayers) ?></p>
</div>
<!--displaying data from the players table, is sorted based on highest grid and playtime.   -->
<table>
    <thead>
        <tr>
            <th>Player ID</th>
            <th>Player Name</th>
            <th>Grid Size</th>
            <th>Play Time (Seconds)</th>
            <th>Created Time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->players as $player): ?>
            <tr>
                <td><?= htmlspecialchars($player['player_id'] ?? '') ?></td>
                <td><?= htmlspecialchars($player['name'] ?? '') ?></td>
                <td><?= htmlspecialchars($player['grid_size'] ?? '') ?></td>
                <td><?= htmlspecialchars($player['play_time_seconds'] ?? '') ?></td>
                <td><?= htmlspecialchars($player['ctime'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
