<nav>
    <img src='icon.png'>
    <a class='ln' href='index.php'> Home </a>
    <?php
    session_start();
    if (!isset($_SESSION['TYPE'])) {
        echo "<a class='ln' href='login.php'> Login </a>";
    } else {
        if ($_SESSION['TYPE'] == 1) {
            echo "<a class='ln' href='dashboard.php'>  Dashboard </a>";
        }

        echo "<a class='ln' href='profile.php'>  Profile </a>";
    }
    ?>
</nav>