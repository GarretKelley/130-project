<?php

include('includes/check-token.php');
validateToken(false);
include('includes/header.php');

?>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <link href="https://www.w3schools.com/w3css/4/w3.css" rel="stylesheet" />
        <table id = "leadTable">
            <tr>
                <th></th>
                <th onclick="w3.sortHTML('#leadTable', '.item', 'td:nth-child(2)')" style="cursor:pointer">Player</th>
                <th onclick="w3.sortHTML('#leadTable', '.item', 'td:nth-child(3)')" style="cursor:pointer">Score</th>
                <th onclick="w3.sortHTML('#leadTable', '.item', 'td:nth-child(4)')" style="cursor:pointer">Time</th>
                <th onclick="w3.sortHTML('#leadTable', '.item', 'td:nth-child(5)')" style="cursor:pointer">Grid size</th>
            </tr>
            <?php
                $connection = connectDB();
                $db_grab = "SELECT players.username, games.level_size, games.duration, games.score FROM
                            players INNER JOIN games ON players.ID = games.player_id";
                $query = mysqli_query($connection, $db_grab);
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr class="item">
                    <td></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['score'];?></td>
                    <td><?php 
                        echo floor($row['duration']/60000);
                        echo ":";
                        echo floor(($row['duration']-($row['duration']/60000))/1000); 
                    ?></td>
                    <td><?php 
                        if ($row['level_size'] == 0)
                            echo "7x7";
                        else if ($row['level_size'] == 1)
                            echo "13x13";
                    ?></td>
                    </tr>
                <?php } ?>
        </table>
	</body>
</html>
