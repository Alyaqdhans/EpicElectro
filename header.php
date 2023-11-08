<?php
$pages = [
    'index.php' => 'Home',
    'login.php' => 'Login',
];

session_start();

$currentFile = basename($file);

echo "<nav>";
foreach ($pages as $fileName => $pageTitle) {
    if ($fileName == $currentFile) {
        echo "<title> $pageTitle </title>";
        
        if ($currentFile == "index.php") {
            echo "<img src='icon.png'>";
        }
    } else {
        switch ($pageTitle) {
            case "Home":
                echo "<a href='index.php'> <img src='icon.png'> </a>";
                break;
            case "Login":
                if (!isset($_SESSION['UID'])) {
                    echo "<a class='ln' href='$fileName'> $pageTitle </a>";
                    break;
                } else {
                    $name = $_SESSION['NAME'];

                    if ($_SESSION['TYPE'] == 1) {
                        $type = "Admin";
                    } else {
                        $type = "Customer";
                    }

                    echo "<a class='ln' href='profile.php'>  $name ($type) </a>
                    <a class='ln' href='logout.php'> Logout </a>";
                    break;
                }
            default:
                echo "<a class='ln' href='$fileName'> $pageTitle </a>";
        }
    }
}
echo "</nav>";
?>