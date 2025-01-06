<?php

/**
 * @var App\Views\IndexView $this
 * @see \App\Controllers\IndexController::chartAjaxAction()
 */

?>
<!--checks if current player is active, otherwise create new player. -->
<div class="row content-container col-xs-12">
    <?php if (!empty($this->currentPlayer)): ?>
        <p>Welcome, <?= htmlspecialchars($this->$currentPlayer['name']) ?>! Ready to play?</p>
    <?php else: ?>
        <form method="post" action="/index/create-player">
            <label for="player_name">Enter your name:</label>
            <input type="text" id="player_name" name="player_name" required />
            <input type="submit" value="Create Player" />
        </form>
    <?php endif; ?>
</div>

<div class="toolbar">
    <form>
        <label for="grid_size">Grid size</label>
        <input
            type="number"
            min="3"
            max="20"
            id="grid_size"
            name="grid_size"
            value="<?= $this->gridSize ?>"
        />
        <input type="submit" value="Play">
    </form>
</div>

<div class="row content-container col-xs-12">
    <div id="game_grid_container">
        <table id="game_grid">
            <?php for ($row = 1; $row <= $this->gridSize; $row++) { ?>
                <tr>
                    <?php
                        for ($col = 1; $col <= $this->gridSize; $col++) {
                            $button_id = 'game_grid_' . $row . '_' . $col;
                            ?>
                        <td>
                            <button id="<?= $button_id ?>" onclick="makeMove('<?= $button_id ?>')"></button>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<!-- Modal to show message -->
<div id="winner-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2>Congratulations, you've won!</h2>
        <div id="leaderboard-container">
            <!-- Leaderboard will be shown inside this container if player have won -->
        </div>
        <button id="close-modal">Close</button>
    </div>
</div>
