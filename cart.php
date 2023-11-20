<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Cart</title>
    </head>
    <body>
        <?php
        include('connect.php');
        include('header.php');

        if (!isset($_SESSION['CART'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        }

        if (count($_SESSION['CART']) > 0) {$hide = "display: flex;";}
        else {$hide = "display: none;";}
        ?>
        
        <form class="wrapper" method="post">
            <div class="container checkout">
                <?php echo "<fieldset style='$hide'>"; ?>
                    <legend>Cart Items</legend>

                    <?php
                    foreach ($_SESSION['CART'] as $key => $item) {
                        if (isset($_POST[$item['ic']]) && $item['ic'] == $_GET['ic']) { // check which item to remove

                            $_SESSION['CART'][$key]['qty'] -= $_POST[$item['ic']]; // remove the amount
                            header("Location: #{$item['ic']}");

                            if ($_SESSION['CART'][$key]['qty'] == 0) { // if qty is 0 remove item from cart
                                unset($_SESSION['CART'][$key]);
                            }
                        }
                    }

                    $prices = [];
                    foreach ($_SESSION['CART'] as $key => $item) {
                        $query = "select * from items where iCode = {$item['ic']}";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                        if (mysqli_num_rows($result) == 0) { // check if item deleted from database
                            unset($_SESSION['CART'][$key]);
                            continue;
                        }

                        $data = mysqli_fetch_assoc($result);

                        echo "<div class='item'>";
                            echo "<div class='img'><img src='images/{$item['ic']}.jpg' alt='{$item['ic']}'></div>";

                            echo "<div class='info'>";
                                echo "<h2> Name: </h2> <h3> {$data['iDesc']} </h3>";
                                echo "<h2> Amount: </h2> <h3> {$item['qty']} </h3>";
                                $price = $item['qty'] * $item['price'];
                                $prices[] = $price;
                                echo "<h2> Price: </h2> <h3> ". number_format($price) ." OMR </h3>";
                            echo "</div>";

                            echo "<div class='amount'>";
                                echo "<div class='control'>";
                                    if ($item['qty'] > 1) {$d = "";}
                                    else {$d = "disabled";}

                                    echo "<input class='less' id=". 'less'.$item['ic'] ." type='button' value=' - ' onclick='controller(\"less\", {$item['ic']})' disabled>";
                                    echo "<span class='number' id=". 'number'.$item['ic'] ."> 1 </span>";
                                    echo "<input class='more' id=". 'more'.$item['ic'] ." type='button' value=' + ' onclick='controller(\"more\", {$item['ic']})' $d>";
                                echo "</div>";

                                echo "<input id=". 'stock'.$item['ic'] ." type='hidden' value='{$item['qty']}'>"; // for javascript
                                echo "<input id=". 'qty'.$item['ic'] ." type='hidden' name='{$item['ic']}' value='1'>";

                                echo "<input type='submit' value='Remove' formaction='cart.php?ic={$item['ic']}'#{$item['ic']}>";
                            echo "</div>";

                            echo "<span class='anchor' id='{$item['ic']}'></span>"; // scrolls user back
                        echo "</div>";

                    }
                    ?>
                </fieldset>

                <div class='bottom'>
                    <?php
                    $total = array_sum($prices);

                    if (empty($_SESSION['CART'])) {$t="Cart Is Empty"; $d = "disabled";}
                    else {$t="Total: ". number_format($total) ." OMR"; $d = '';}
                    
                    echo "<h4> $t </h4>";
                    echo "<input type='submit' value='Checkout' formaction='cartProcess.php' $d>";
                    ?>
                </div>

            </div>
        </form>

        <div class="scroll">
            <a class="btn up" href="#up">▲</a>
            <a class="btn down" href="#down">▼</a>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>