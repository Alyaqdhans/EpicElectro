<nav id="up">
    <a class='ln' href='index.php'> Home </a>
    <?php
    session_start();
    if (!isset($_SESSION['TYPE'])) {
        echo "<a class='ln' href='login.php'> Login </a>";
    } else {
        echo "<a class='ln' href='order.php'>  Orders </a>";

        if ($_SESSION['TYPE'] == 'A') {
            echo "<a class='ln' href='panel.php'>  Panel </a>";
        }

        echo "<a class='ln' href='profile.php'>  Profile </a>";
    }
    ?>
</nav>

<div id="notify" class="notify-wrap unnotify">
    <div class="notify">
        <span id="span"></span>
        <input type="button" value="&times;" onclick="notifyHide();">
    </div>
</div>

<div id="loading" class="hide-loading">
    <h1>Processing</h1>
</div>