<?php
session_start(); 
if (!isset($_SESSION['CART'])) {
    header('Location: error.php?ec=1'); // login required
    exit;
}
?>
<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Cart</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');

        if (!empty($_GET['ic']) && array_key_exists($_GET['ic'], $_SESSION['CART']) && isset($_POST[$_GET['ic']])) {
            $_SESSION['CART'][$_GET['ic']]['qty'] -= $_POST[$_GET['ic']]; // remove the amount

            if ($_SESSION['CART'][$_GET['ic']]['qty'] == 0) { // if qty is 0 remove item from cart
                unset($_SESSION['CART'][$_GET['ic']]);
            }
        }

        if (count($_SESSION['CART']) == 0) {$hide = "style='display: none;'";}
        else {$hide = "";}
        ?>
        
        <div>
        <form class="wrapper" method="post">
            <div class="container checkout">
                <?php echo "<fieldset $hide>"; ?>
                    <legend>Cart Contents</legend>

                    <?php
                    $prices = [];
                    foreach ($_SESSION['CART'] as $key => $item) {
                        $query = "select * from items where iCode = {$key}";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                        if (mysqli_num_rows($result) == 0) { // check if item deleted from database
                            unset($_SESSION['CART'][$key]);
                            continue;
                        }

                        $data = mysqli_fetch_assoc($result);

                        echo "<div class='item'>";
                            echo "<a href='view.php?ic=$key'><div class='img'><img src='images/{$key}.{$data['img_ext']}' alt='{$key}'></div></a>";

                            echo "<div class='info'>";
                                echo "<h2> Name: </h2> <h3> {$data['iDesc']} </h3>";
                                echo "<h2> Price: </h2> <h3> ". number_format($item['price']) ." OMR </h3>";
                                echo "<h2 id='in'> Quantity: </h2> <h3 id='in'> {$item['qty']} </h3>";
                                $price = $item['qty'] * $item['price'];
                                $prices[] = $price;
                                // echo "<h2> Sub-Total: </h2> <h3> ". number_format($price) ." OMR </h3>";
                            echo "</div>";

                            echo "<div class='amount'>";
                                // echo "<h4> Available: {$data['iQty']} </h4>";

                                echo "<div class='control'>";
                                    if ($item['qty'] > 1) {$d = "";}
                                    else {$d = "disabled";}

                                    echo "<input class='less' id=". 'less'.$key ." type='button' value='&minus;' onclick='controller(\"less\", {$key})' disabled>";
                                    echo "<span class='number' id=". 'number'.$key ."> 1 </span>";
                                    echo "<input class='more' id=". 'more'.$key ." type='button' value='&plus;' onclick='controller(\"more\", {$key})' $d>";
                                echo "</div>";

                                echo "<input type='submit' value='Remove' formaction='cart.php?ic={$key}#{$key}'>";
                                
                                echo "<input id=". 'stock'.$key ." type='hidden' value='{$item['qty']}'>"; // max value for javascript
                                echo "<input id=". 'qty'.$key ." type='hidden' name='{$key}' value='1'>";
                            echo "</div>";

                            echo "<span class='anchor' id='{$key}'></span>"; // scrolls user back
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
                    echo "<input id='sb' type='button' value='Checkout' onclick='d.showModal();' $d>";
                    echo "<h6>*Payment is cash on delivery, no online payment.</h6>";

                    echo "<input type='hidden' name='total' value='$total'>";
                    ?>
                </div>

                <dialog class="modal" id="d">
                    <h1>Confirmation</h1>
                    <h2>Are you sure you want to checkout?</h2>
                    <div class="btns">
                        <input type="submit" value="Confirm" formaction="cartProcess.php" onclick="d.close(); loading();">
                        <input type="button" value="&times;" onclick="d.close();">
                    </div>
                </dialog>

            </div>
        </form>
        </div>

        <div class="scroll">
            <a class="btn up" href="#up">▲</a>
            <a class="btn down" href="#down">▼</a>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>