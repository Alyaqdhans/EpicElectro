<?php
function DisplayErrors() {
    global $errors;
    echo "<html>";
        echo "<head>";
            include('link.php');
            echo "<title>EpicElectro | Error</title>";
        echo "</head>";
        echo "<body>";
            echo "<div class='error'>";
            echo "<fieldset>";
            echo "<legend style='color: var(--red);'>Could Not Process Data</legend>";
            echo "<h3>The following errors found in data inputs</h3>";
            echo "<ul>";
            foreach($errors as $v) {
                echo "<li> <mark>$v</mark> </li>";
            }
            echo "</ul>";
            echo "</fieldset>";
            echo "<a id='eback' href=javascript:history.back()> Go Back </a></b> <br>";
            echo "</div>";
        echo "</body>";
    echo "</html>";
}

function fdate($d) {
    $date = explode("-", $d);
    return ($date[2]."/".$date[1]."/".$date[0]);
}
?>