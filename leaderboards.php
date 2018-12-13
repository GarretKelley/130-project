<?php

include('includes/check-token.php');
validateToken(false);
include('includes/header.php');

?>
        <script src="https://www.w3schools.com/lib/w3.js"></script>
        <link href="https://www.w3schools.com/w3css/4/w3.css" rel="stylesheet" />
        <table id = "Arcade7Table">
            <caption> Arcade Mode 7x7 leaderboards </caption>
            <tr>
                <th onclick="w3.sortHTML('#Arcade7Table', '.item', 'td:nth-child(1)')" style="cursor:pointer">Player</th>
                <th onclick="w3.sortHTML('#Arcade7Table', '.item', 'td:nth-child(2)')" style="cursor:pointer">Score</th>
                <th onclick="w3.sortHTML('#Arcade7Table', '.item', 'td:nth-child(3)')" style="cursor:pointer">Time</th>
            </tr>
            <?php
                $connection = connectDB();
                $db_grab = "SELECT players.username, games.duration, games.score FROM
                            players INNER JOIN games ON players.ID = games.player_id
                            WHERE games.level_mode='arcade' AND games.level_size=0";
                $query = mysqli_query($connection, $db_grab);
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr class="item">
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['score'];?></td>
                    <td><?php 
                        echo floor($row['duration']/60000);
                        echo ":";
                        echo floor(($row['duration']-($row['duration']/60000))/1000); 
                    ?></td>
                    </tr>
                <?php } ?>
        </table>
        <table id = "Arcade13Table">
            <caption> Arcade Mode 13x13 leaderboards </caption>
            <tr>
                <th onclick="w3.sortHTML('#Arcade13Table', '.item', 'td:nth-child(1)')" style="cursor:pointer">Player</th>
                <th onclick="w3.sortHTML('#Arcade13Table', '.item', 'td:nth-child(2)')" style="cursor:pointer">Score</th>
                <th onclick="w3.sortHTML('#Arcade13Table', '.item', 'td:nth-child(3)')" style="cursor:pointer">Time</th>
            </tr>
            <?php
                $connection = connectDB();
                $db_grab = "SELECT players.username, games.duration, games.score FROM
                            players INNER JOIN games ON players.ID = games.player_id
                            WHERE games.level_mode='arcade' AND games.level_size=1";
                $query = mysqli_query($connection, $db_grab);
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr class="item">
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['score'];?></td>
                    <td><?php 
                        echo floor($row['duration']/60000);
                        echo ":";
                        echo floor(($row['duration']-($row['duration']/60000))/1000); 
                    ?></td>
                    </tr>
                <?php } ?>
        </table>
        <table id = "Time7Table">
            <caption> Time attack 7x7 leaderboards </caption>
            <tr>
                <th onclick="w3.sortHTML('#Time7Table', '.item', 'td:nth-child(1)')" style="cursor:pointer">Player</th>
                <th onclick="w3.sortHTML('#Time7Table', '.item', 'td:nth-child(2)')" style="cursor:pointer">Score</th>
                <th onclick="w3.sortHTML('#Time7Table', '.item', 'td:nth-child(3)')" style="cursor:pointer">Time</th>
            </tr>
            <?php
                $connection = connectDB();
                $db_grab = "SELECT players.username, games.duration, games.score FROM
                            players INNER JOIN games ON players.ID = games.player_id
                            WHERE games.level_mode='rand' AND games.level_size=0";
                $query = mysqli_query($connection, $db_grab);
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr class="item">
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['score'];?></td>
                    <td><?php 
                        echo floor($row['duration']/60000);
                        echo ":";
                        echo floor(($row['duration']-($row['duration']/60000))/1000); 
                    ?></td>
                    </tr>
                <?php } ?>
        </table>
        <table id = "Time13Table">
            <caption> Time attack 13x13 leaderboards </caption>
            <tr>
                <th onclick="w3.sortHTML('#Time13Table', '.item', 'td:nth-child(1)')" style="cursor:pointer">Player</th>
                <th onclick="w3.sortHTML('#Time13Table', '.item', 'td:nth-child(2)')" style="cursor:pointer">Score</th>
                <th onclick="w3.sortHTML('#Time13Table', '.item', 'td:nth-child(3)')" style="cursor:pointer">Time</th>
            </tr>
            <?php
                $connection = connectDB();
                $db_grab = "SELECT players.username, games.duration, games.score FROM
                            players INNER JOIN games ON players.ID = games.player_id
                            WHERE games.level_mode='rand' AND games.level_size=1";
                $query = mysqli_query($connection, $db_grab);
                while ($row = mysqli_fetch_array($query)) { ?>
                    <tr class="item">
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['score'];?></td>
                    <td><?php 
                        echo floor($row['duration']/60000);
                        echo ":";
                        echo floor(($row['duration']-($row['duration']/60000))/1000); 
                    ?></td>
                    </tr>
                <?php } ?>
        </table>
	</body>
</html>
