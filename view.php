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

        <form class="container" method="post" action="viewProcess.php">
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
                    <div class="control">
                        <button id="less"> - </button>
                        <span id='number'> 1 </span>
                        <button id="more"> + </button>
                    </div>

                    <?php
                    if ($data['iQty'] > 0) {
                        echo "<span> Available: {$data['iQty']} </span>";
                        echo "<input id='submit' type='submit' value='Add'>";
                    } else {
                        echo "<span> Not Available </span>";
                        echo "<input id='submit' type='submit' value='Add' disabled>";
                    }
                    ?>
                                        
                    <input type='hidden' name='qty' value='1'>
                </div>

                <a class="back" href="index.php">Back</a>
            </aside>
        </form>

        <?php include("footer.php"); ?>
    </body>
</html>