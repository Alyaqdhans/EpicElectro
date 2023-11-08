<footer>
    &copy; Copyright Reserved to 
    <abbr title="University of Technology and Applied Sciences">UTAS</abbr>
    <?php
    if (isset($_SESSION['NAME'])) {
        $name = $_SESSION['NAME'];

        if ($_SESSION['TYPE'] == 1) {
            $type = "Admin";
        } else {
            $type = "Customer";
        }

        echo " | $name ($type) <a href='logout.php'> Logout </a>";
    }
    ?>
</footer>