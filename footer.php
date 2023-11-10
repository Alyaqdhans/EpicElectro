<footer>
    &copy; Copyright of EpicElectro is Reserved to 
    <abbr title="University of Technology and Applied Sciences">UTAS</abbr>
    <?php
    if (isset($_SESSION['NAME'])) {
        $name = $_SESSION['NAME'];

        if ($_SESSION['TYPE'] == 'A') {
            $type = "Admin";
        } else {
            $type = "Normal";
        }

        echo " | $name ($type) <a href='logout.php'> Logout </a>";
    }
    ?>
</footer>