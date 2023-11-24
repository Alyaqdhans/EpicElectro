<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Delivers</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');

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
            <form class="container create" action="panelDeliveryNewProcess.php" method="post">
                <fieldset>
                    <legend>New Deliver</legend>

                    <label>
                        Deliver Name:<br>
                        <input type="text" name="name" required>
                    </label>

                    <label>
                        Deliver Phone:<br>
                        <input type="number" name="phone" required>
                    </label>
                </fieldset>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Save">
                    <a class="btn right" href='panelDelivery.php'> Cancel </a>
                </div>

            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>