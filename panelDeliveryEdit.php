<?php
session_start();
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

if (empty($_GET['did'])) {
    header('Location: error.php'); // check if data token exist
    exit;
}

$query = "select * from Delivery where dId = '{$_GET['did']}'";
$result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    header('Location: error.php?ec=12'); // check if item exist
    exit;
}
?>
<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Couriers</title>
    </head>
    <body>
        <?php include('header.php'); ?>
        
        <div class="wrapper">
            <form class="container create" action="panelDeliveryEditProcess.php" method="post">
                <fieldset>
                    <legend>Edit Courier</legend>

                    <?php echo "<input type='hidden' name='code' value='{$_GET['did']}'>"; ?>

                    <label>
                        Courier Name:<br>
                        <?php echo "<input type='text' name='name' value='{$data['company_name']}' required>"; ?>
                    </label>

                    <label>
                        Courier Phone:<br>
                        <?php echo "<input type='number' name='phone' value='{$data['dPhone']}' required>"; ?>
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