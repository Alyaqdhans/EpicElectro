<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Receipt</title>
    </head>
    <body>
        <?php
        include('header.php');
        include("connect.php");

        if (!isset($_GET['oi'])) {
            header('Location: error.php?ec=-1'); // entered page without button
            exit;
        }
        ?>

        <div class="wrapper">
            <div class="container receipt">
                <fieldset>
                    <legend>Purchased Successfuly</legend>

                    <h3>Thank you for your purchase from EpicElectro, a receipt will be 
                        sent to the email linked to this account shortly.</h3>

                    <div id="main">
                        <h1>Meanwhile</h1>

                        <h2>Check our other products:</h2>
                        <a href="index.php">Home</a>
                        
                        <h2>Or see your orders history:</h2>
                        <a href="order.php">Orders</a>
                        
                        <h5>Order No: <?php echo $_GET['oi']; ?></h5>
                    </div>
                </fieldset>
            </div>
        </div>
        
        <?php include('footer.php'); ?>
    </body>
</html>