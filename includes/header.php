<?php

include_once('php/connection.php');
connectDB();
 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Picross</title>
    <?php
        $currentName = basename($_SERVER['PHP_SELF']);
        $cssFile = explode('.', $currentName)[0];
        print("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/base.css\"/>\n");
        print("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/$cssFile.css\"/>\n");
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
			crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="buttons">
        <?php
        if ($GLOBALS['is_logged_in']) {
            echo("<a href=\"javascript:logout()\"><button>Logout</button></a>");
        } else {
            if (preg_match('/index.php$/', $_SERVER['PHP_SELF'])) {
                echo("<a class=\"current\"><button>Login</button></a>");
            } else {
                echo("<a href=\"/130-project\"><button>Login</button></a>");
            }
        }
        ?>
        <script type="text/javascript">
        function logout() {
            document.cookie = "<?php include('php/token.php'); echo($token_cookie_name); ?>=0;expires=0;path=/";
            location.reload(true);
        }
        </script>
        <?php
        if (preg_match('/howto.php$/', $_SERVER['PHP_SELF'])) {
            echo("<a class=\"current\"><button>How to play &raquo;</button></a>");
        } else {
            echo("<a href=\"howto.php\"><button>How to play &raquo;</button></a>");
        }
        if (preg_match('/about.php$/', $_SERVER['PHP_SELF'])) {
            echo("<a class=\"current\"><button>About the authors &raquo;</button></a>");
        } else {
            echo("<a href=\"about.php\"><button>About the authors &raquo;</button></a>");
        }
        if (preg_match('/leaderboards.php$/', $_SERVER['PHP_SELF'])) {
            echo("<a class=\"current\"><button> Leaderboards &raquo;</button></a>");
        } else {
            echo("<a href=\"leaderboards.php\"><button>Leaderboards &raquo;</button></a>");
        }
        if ($GLOBALS['is_logged_in']) {
            if (preg_match('/game.php$/', $_SERVER['PHP_SELF'])) {
                echo("<a class=\"current\"><button>PLAY</button></a>");
            } else {
                echo("<a href=\"game.php\"><button>PLAY</button></a>");
            }
            echo("
            <label for=\"profile-upload\">
                <img 
                        alt=\"Upload a profile picture\" 
                        src=\"/130-project/profile-pics/".$GLOBALS['user_id'].".jpg\"
                        height=\"100\"
                />
            </label>
            <input id=\"profile-upload\" type=\"file\"/>");
        }
        ?>
        <script type="text/javascript">
            $('#profile-upload').on('change', function() {
                var file_data = $('#profile-upload').prop('files')[0];   
                var form_data = new FormData();                  
                form_data.set('file', file_data, '<?php echo($GLOBALS['user_id']); ?>.jpg');
                var ajaxRequest = new XMLHttpRequest();
                ajaxRequest.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        location.reload(true);
                    }
                };
                ajaxRequest.open("POST", "ajax/upload-pic.php");
                ajaxRequest.send(form_data);
            });
        </script>
    </div>
</header>