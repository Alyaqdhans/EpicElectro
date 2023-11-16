<html>
    <head>
        <?php include('link.php') ?>
        <title>Orders</title>
    </head>
    <body>
        <?php
        include('header.php');

        if (!isset($_SESSION['CART'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        }
        ?>
        
        <div class="wrapper">
            <div class="container">
                <fieldset>
                    <legend>Orders</legend>
                    
                </fieldset>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>