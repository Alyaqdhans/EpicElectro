<footer id="down">
    &copy; Copyright of EpicElectro is Reserved to 

    <span title="University of Technology and Applied Sciences" style="border-bottom: 2px dotted black;">UTAS</span>

    <?php
    if (isset($_SESSION['NAME'])) {

        $fullName = explode(" ", $_SESSION['NAME']);
        if (count($fullName) > 1) {
            $Fname = $fullName[0];
            $Lname = array_pop($fullName);
            $name = $Fname." ".$Lname;
        } else {
            $name = $fullName[0];
        }

        echo " ︱ $name (<a href='logout.php'>Logout</a>)";
    }
    ?>
</footer>

<script src="main.js"></script>