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
        ?>
        
        <form class="wrapper">
            <div class="container" style="padding: 2rem;">
                <fieldset>
                    <legend>Cart</legend>
                    <?php echo print_r($_SESSION['CART']); ?>
                </fieldset>
            </div>
        </form>

        <?php include('footer.php'); ?>
    </body>
</html>