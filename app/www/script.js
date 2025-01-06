function makeMove(buttonId) {
  setButtonsValue(buttonId, "X");
  makeOpponentsTurn();
}

function makeOpponentsTurn() {
  const matrix = [];

  let row = 1;
  let col = 1;
  let rowTexts = [];
  do {
    const buttonId = `game_grid_${row}_${col}`;

    // Very end of the matrix.
    if (document.getElementById(buttonId) == null && col === 1) {
      break;
    }

    // End of the row.
    if (document.getElementById(buttonId) == null) {
      matrix.push(rowTexts);
      row++;
      col = 1;
      rowTexts = [];
      continue;
    }

    rowTexts.push(document.getElementById(buttonId).innerText);
    col++;
  } while (true);

  fetch("/index/opponents-turn", {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ matrix: matrix }),
  })
    .then((response) => {
      if (response.ok) {
        return response.json();
      }
      return Promise.reject(response); // 2. reject instead of throw
    })
    .then((json) => {
      let is_game_over = json.is_game_over;
      let is_player_win = json.is_player_win;
      let is_computer_win = json.is_computer_win;

      if (!is_game_over || !is_player_win) {
        let row = json.row + 1;
        let col = json.col + 1;
        const buttonId = `game_grid_${row}_${col}`;
        setButtonsValue(buttonId, "O");
      }

      if (is_game_over) {
        document.querySelectorAll("#game_grid button").forEach((button) => {
          button.disabled = true;
        });
        //added leaderboard when player wins
        if (is_player_win) {
          fetch("/index/get-all-players")
            .then((response) => response.json())
            .then((data) => {
              const players = data.players;
              let leaderboardHTML = "<table>";
              leaderboardHTML += `
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
              `;
              players.forEach((player) => {
                leaderboardHTML += `
                    <tr>
                        <td>${player.player_id}</td>
                        <td>${player.name}</td>
                        <td>${player.grid_size}</td>
                        <td>${player.play_time_seconds}</td>
                        <td>${player.ctime}</td>
                    </tr>
                `;
              });
              leaderboardHTML += "</tbody></table>";

              document.getElementById("leaderboard-container").innerHTML =
                leaderboardHTML;
              document.getElementById("winner-modal").style.display = "flex";
            })
            .catch((err) => console.error("Error fetching all players:", err));
        } else if (is_computer_win) {
          alert("Computer won!");
        } else {
          alert("Nobody won :(");
        }
      }
    })
    .catch((error) => console.error("Error:", error));
}

// Modal close logic, had to add domcontentloaded because js was running before the html 
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById('close-modal').addEventListener('click', () => {
      document.getElementById('winner-modal').style.display = 'none';

      resetGameGrid();
  });
});
//grid wasnt resetting after i added dom contetloaded, had to create new function that resets gamegrid
function resetGameGrid() {
  const buttons = document.querySelectorAll("#game_grid button");
  buttons.forEach(button => {
    button.innerText = "";
    button.disabled = false;
  });
}

function setButtonsValue(buttonId, text) {
  document.getElementById(buttonId).innerText = text;
  document.getElementById(buttonId).disabled = true;
}
