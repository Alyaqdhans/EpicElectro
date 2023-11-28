<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Error</title>
    </head>
    <body>
        <?php
        function DisplayErrors() {
            global $errors;
            echo "<div class='error'>";
            echo "<fieldset>";
            echo "<legend style='color:red;'>Could Not Process Data</legend>";
            echo "<h3>The following errors found in data inputs</h3>";
            echo "<ul>";
            foreach($errors as $v) {
                echo "<li> <mark>$v</mark> </li>";
            }
            echo "</ul>";
            echo "</fieldset>";
            echo "<a href=javascript:history.back()> Go Back </a></b> <br>";
            echo "</div>";
        }

        function fdate($d) {
            $date = explode("-", $d);
            return ($date[2]."/".$date[1]."/".$date[0]);
        }
        ?>
    </body>
</html>