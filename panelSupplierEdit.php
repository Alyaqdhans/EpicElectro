<?php session_start(); ?>
<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Suppliers</title>
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
            <form class="container create" action="panelSupplierEditProcess.php" method="post">
                <fieldset>
                    <legend>Edit Supplier</legend>

                    <?php
                    $query = "select * from suppliers where sId = '{$_GET['sid']}'";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    $data = mysqli_fetch_assoc($result);

                    echo "<input type='hidden' name='code' value='{$_GET['sid']}'>";
                    ?>

                    <label>
                        Supplier Name:<br>
                        <?php echo "<input type='text' name='name' value='{$data['sName']}' required>"; ?>
                    </label>

                    <label>
                        Supplier Phone:<br>
                        <?php echo "<input type='number' name='phone' value='{$data['sPhone']}' required>"; ?>
                    </label>

                    <label>
                        Supplier Email:<br>
                        <?php echo "<input type='email' name='email' value='{$data['sEmail']}' required>"; ?>
                    </label>

                    <label>
                        Supplier Address:<br>
                        <?php echo "<textarea name='address' cols='50' rows='8' required>{$data['sAddress']}</textarea>"; ?>
                    </label>
                </fieldset>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Save">
                    <a class="btn right" href='panelSupplier.php'> Cancel </a>
                </div>

            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>