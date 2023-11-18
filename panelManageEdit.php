<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Edit</title>
    </head>
    <body>
        <?php
        include('header.php');

        if (!isset($_SESSION['TYPE'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        } else {
            if ($_SESSION['TYPE'] != 'A') {
                header('Location: error.php?ec=3'); // need admin
                exit;
            }
        }
        ?>
        
        <div class="wrapper">
            <div class="container">
                <fieldset>
                    <legend>Edit Item</legend>
                    
                </fieldset>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>