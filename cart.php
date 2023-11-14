<html>
    <head>
        <?php include('link.php') ?>
        <title>Cart</title>
    </head>
    <body>
        <?php
        include('header.php');

        if (!isset($_SESSION['CART'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        }

        echo print_r($_SESSION['CART']);
        ?>
        
        

        <?php include('footer.php'); ?>
    </body>
</html>