<footer id="down">
    <label>
        <select id="theme">
            <option value="system">System</option>
            <option value="manual" selected>Manual</option>
        </select>
        <input type="checkbox" id="dark-mode">
    </label>

    <label>
        &copy; Copyright of EpicElectro is Reserved to 
        <abbr title="University of Technology and Applied Sciences">UTAS</abbr>
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