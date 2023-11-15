<html>
    <head>
        <?php include('link.php'); ?>
        <title>Cart</title>
    </head>
    <body>
        <?php
        include('connect.php');
        include('header.php');

        if (!isset($_SESSION['CART'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        }
        ?>
        
        <form class="wrapper" method="post">
            <div class="container">
                <fieldset>
                    <legend>Cart</legend>
                    
                    <?php
                    $total = [];
                    foreach ($_SESSION['CART'] as $key => $item) {
                        
                        $query = "select * from items where {$item['ic']}";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        $data = mysqli_fetch_assoc($result);

                        echo "<div class='item'>";
                            echo "<img src='images/{$item['ic']}.jpg' alt='Image'>";
                            echo "<h4>Item Name: {$data['iDesc']}</h4>";
                            $p = number_format($item['price']);
                            echo "<h4>Item Price: $p</h4>";
                            echo "<h4>Number of items selected: {$item['qty']}</h4>";
                            echo "<input type='submit' value='Remove'>";

                            // total price
                            $price = intval($item['price']);
                            $qty = intval($item['qty']);
                            $t = $price * $qty;
                            $total[] = $t;
                        echo "</div>";
 
                    }
                    // display total price
                    echo "<div>";
                        $to = number_format(array_sum($total));
                        echo "<h4>Total price: $to OMR</h4>";
                    echo "</div>";

                    // checkout
                    if (empty($_SESSION['CART'])) {$d = 'disabled';}
                    else {$d = '';}
                    
                    echo "<input type='submit' value='Checkout' formaction='cartProcess.php' $d>";
                    ?>
                </fieldset>
            </div>
        </form>

        <?php include('footer.php'); ?>
    </body>
</html>