<?php
session_start();
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
<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Suppliers</title>
    </head>
    <body>
        <?php include('header.php'); ?>
        
        <div>
        <div class="wrapper">
            <form class="container create" action="panelSupplierNewProcess.php" method="post">
                <fieldset>
                    <legend>New Supplier</legend>

                    <label>
                        Supplier Name:<br>
                        <input type="text" name="name" required>
                    </label>

                    <label>
                        Supplier Phone:<br>
                        <input type="number" name="phone" required>
                    </label>

                    <label>
                        Supplier Email:<br>
                        <input type="email" name="email" required>
                    </label>

                    <label>
                        Supplier Address:<br>
                        <textarea name="address" cols="50" rows="8" required></textarea>
                    </label>
                </fieldset>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Save">
                    <a class="btn right" href='panelSupplier.php'> Cancel </a>
                </div>

            </form>
        </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>