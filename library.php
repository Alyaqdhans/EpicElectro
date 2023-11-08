<html>
    <header>
        <link rel="stylesheet" href="style.css">
        <title>Error</title>
    </header>
    <body>
        <?php
        function DisplayErrors() {
            global $errors;
            echo "<div class='error'>";
            echo "<h3 style='color:red;'>Could Not Save or process data</h3> <p>";
            echo "<b>The following errors found in data inputs</b>";
            echo "<ol>";
            foreach($errors as $k=>$v) {
                echo "<li><mark>$v</mark></li>";
            }
            echo "</ol>";
            echo "<a href=javascript:history.back()> Click here to correct these errors </a> <br>";
            echo "</div>";
        }
        ?>
    </body>
</html>