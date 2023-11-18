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
            echo "<legend style='color:red;'>Could Not Save or process data</legend>";
            echo "<b>The following errors found in data inputs";
            echo "<ul>";
            foreach($errors as $v) {
                echo "<li><mark>$v</mark></li>";
            }
            echo "</ul>";
            echo "</fieldset>";
            echo "<a href=javascript:history.back()> Go Back </a></b> <br>";
            echo "</div>";
        }
        ?>
    </body>
</html>