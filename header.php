<nav id="up">
    <a class='ln' href='index.php'> Home </a>
    <?php
    session_start();
    if (!isset($_SESSION['TYPE'])) {
        echo "<a class='ln' href='login.php'> Login </a>";
    } else {
        if ($_SESSION['TYPE'] == 'A') {
            echo "<a class='ln' href='panel.php'>  Panel </a>";
        }

        echo "<a class='ln' href='profile.php'>  Profile </a>";
    }
    ?>
</nav>