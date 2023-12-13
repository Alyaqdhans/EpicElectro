<footer id="down">
    <label>
        &copy; Copyright is reserved to 
        <abbr title="s26s2025@nct.edu.om">Alyaqdhan</abbr>,
        <abbr title="s26s1969@nct.edu.om">Hassan</abbr>,
        <abbr title="s76s1937@nct.edu.om">Abdullrahman</abbr> &
        <a href="https://www.utas.edu.om/" target="_blank" 
        title="University of Technology and Applied Sciences of Nizwa">UTAS Nizwa</a>
    </label>

    <label>
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

            echo "$name (<a href='logout.php'>Logout</a>)";
        }
        ?>
    </label>
</footer>

<script src="main.js"></script>