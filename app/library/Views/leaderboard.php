<?php

/**
 * @var \App\Views\LeaderboardView $this
 * @see \App\Controllers\IndexController::chartAjaxAction()
 */

?>

<div class="row content-container col-xs-12">
   
</div>
<!--displaying data from the players table, will change again soon for cleaner look, need to sort based on highest ranking.   -->
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
