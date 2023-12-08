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

if (empty($_GET['sid'])) {
    header('Location: error.php'); // check if data token exist
    exit;
}

$query = "select * from suppliers where sId = '{$_GET['sid']}'";
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
        <?php include('link.php'); ?>
        <title>EpicElectro | Suppliers</title>
    </head>
    <body>
        <?php include('header.php'); ?>
        
        <div class="wrapper">
            <div class="container manage address">
                <fieldset>
                    <legend>Supplier Address</legend>

                    <h3><?php echo $data['sAddress']; ?></h3>
                </fieldset>
                
                <div class="buttons">
                    <a href='panelSupplier.php'> Back </a>
                </div>

            </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>