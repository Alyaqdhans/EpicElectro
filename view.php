<html>
    <head>
        <?php include('link.php'); ?>
        <title>View</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');
        ?>

        <?php
        $query = "select * from items where iCode = {$_GET['ic']}";
        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
        $data = mysqli_fetch_assoc($result);
        ?>

        <form class="wrapper" method="post" action="viewProcess.php">
            <div class="container view">
                <section>
                    <?php
                    echo "<img src='images/{$_GET['ic']}.jpg' alt='Image'>";
                    echo "<h3> {$data['iDesc']} </h3>";
                    if (empty($data['iComment'])) {
                        echo "<h4> No Description Found </h4>";
                    } else {
                        echo "<h4> {$data['iComment']} </h4>";
                    }
                    echo "<h5>by {$data['iBrand']}</h5>";
                    ?>
                </section>

                <aside>
                    <div class="cart">
                        <a href="cart.php">Cart</a>
                        <span style="background: var(--clr-primary-light); color: white;">
                            <?php
                            if (isset($_SESSION['CART'])) {
                                echo count($_SESSION['CART']);
                            } else {
                                echo 0;
                            }
                            ?>
                        </span>
                    </div>

                    <div class="amount">
                        <?php echo "<span> Price: ". number_format($data['iPrice']) ." OMR </span>"; ?>

                        <div class="control">
                            <?php
                            if ($data['iQty'] > 0) {$n = 1; $d = "";}
                            else {$n = 0; $d = "disabled";}
                            
                            echo "<input id='less' type='button' value=' - ' onclick='controller(\"less\")' disabled>";
                            echo "<span id='number'> $n </span>";
                            echo "<input id='more' type='button' value=' + ' onclick='controller(\"more\")' $d>";

                            echo "<input id='stock' type='hidden' value='{$data['iQty']}'>"; // for javascript
                            ?>
                        </div>

                        <?php
                        if ($data['iQty'] > 0) {
                            echo "<span> Available: {$data['iQty']} </span>";
                            $d = "";
                        } else {
                            echo "<span> Not Available </span>";
                            $d = "disabled";
                        }
                        echo "<input id='submit' type='submit' value='Add' $d>";

                        echo "<input type='hidden' name='ic' value='{$_GET['ic']}'>";
                        echo "<input type='hidden' name='price' value='{$data['iPrice']}'>";
                        echo "<input id='qty' type='hidden' name='qty' value='1'>";
                        ?>
                    </div>

                    <?php echo "<a class='back' href='index.php#{$_GET['ic']}'>Back</a>"; ?>
                </aside>
            </div>
        </form>

        <?php include("footer.php"); ?>
    </body>
</html>