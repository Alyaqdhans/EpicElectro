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
            <div class="container checkout">
                <?php
                foreach ($_SESSION['CART'] as $key => $item) { // remove the amount
                    if (isset($_POST[$item['ic']])) {
                        $remove = intval($_POST[$item['ic']]);

                        if ($remove > 0) {
                            if ($remove > $item['qty']) {
                                $_SESSION['CART'][$key]['qty'] = 0;
                            } else {
                                $_SESSION['CART'][$key]['qty'] -= $remove;
                                header("Location: #{$item['ic']}");
                            }

                            if ($_SESSION['CART'][$key]['qty'] == 0) {
                                unset($_SESSION['CART'][$key]);
                            }
                        }
                    }
                }

                $total = [];
                foreach ($_SESSION['CART'] as $key => $item) {
                    $query = "select * from items where iCode = {$item['ic']}";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    $data = mysqli_fetch_assoc($result);

                    echo "<div class='item'>";
                        echo "<img src='images/{$item['ic']}.jpg' alt='Image'>";

                        echo "<div class='info'>";
                            echo "<h2> Name: </h2> <h3> {$data['iDesc']} </h3>";
                            $p = number_format($item['price']);
                            echo "<h2> Price: </h2> <h3> $p </h3>";
                            echo "<h2> Amount: </h2> <h3> {$item['qty']} </h3>";
                            $sub = number_format($item['qty'] * $item['price']);
                            echo "<h2> Price: </h2> <h3> $sub OMR </h3>";
                        echo "</div>";

                        echo "<div class='amount'>";
                            echo "<input type='number' name='{$item['ic']}' value='0'>";
                            echo "<input type='submit' value='Remove' formaction='cart.php'>";
                        echo "</div>";

                        // total price
                        $price = intval($item['price']);
                        $qty = intval($item['qty']);
                        $total[] = ($price * $qty);

                        echo "<span class='anchor' id='{$item['ic']}'></span>"; // scrolls user back
                    echo "</div>";

                }

                echo "<div class='bottom'>";
                    $total = number_format(array_sum($total));

                    if (empty($_SESSION['CART'])) {$t="Cart Is Empty"; $d = "disabled";}
                    else {$t="Total: $total OMR"; $d = '';}
                    
                    echo "<h4> $t </h4>";
                    echo "<input type='submit' value='Checkout' formaction='cartProcess.php' $d>";
                echo "</div>";
                ?>
            </div>
        </form>

        <div class="scroll">
            <a class="btn up" href="#up">▲</a>
            <a class="btn down" href="#down">▼</a>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>