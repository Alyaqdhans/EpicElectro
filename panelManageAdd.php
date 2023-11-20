<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Supply</title>
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
            <form class="container create" action="panelManageAddProcess.php" method="post">
                <fieldset>
                    <legend>Add Supply</legend>

                    <?php
                    $query = "select * from items where iCode = '{$_GET['ic']}'";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    $data = mysqli_fetch_assoc($result);

                    echo "<input type='hidden' name='code' value='{$_GET['ic']}'>";
                    echo "<input type='hidden' name='prevqty' value='{$data['iQty']}'>";
                    ?>

                    <label>
                        Item Name:<br>
                        <?php echo "<h3>[ {$data['iDesc']} ]</h3>"; ?>
                    </label>

                    <label>
                        Item Supplier:<br>
                        <?php
                        echo "<select name='supplier' required>";
                        echo "<option value=''> Suppliers </option>";

                        $query = "select * from suppliers";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        while ($data2 = mysqli_fetch_assoc($result)) {
                            if ($data2['sId'] == $data['iSupplierId']) {$s = "selected";}
                            else {$s = "";}
                            echo "<option value='{$data2['sId']}' $s> {$data2['sName']} </option>";
                        }
                        echo "</select>";
                        ?>
                    </label>

                    <label>
                        Item Quantity:<br>
                        <?php echo "<input type='number' name='qty' value='{$data['iQty']}' required>"; ?>
                    </label>

                    <label>
                        Item Cost: (Purchased for)<br>
                        <?php echo "<input type='number' name='cost' value='{$data['iCost']}' required>"; ?>
                    </label>

                    <label>
                        Item Price: (Sell for)<br>
                        <?php echo "<input type='number' name='price' value='{$data['iPrice']}' required>"; ?>
                    </label>
                </fieldset>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Save">
                    <a class="btn right" href='panelManage.php'> Cancel </a>
                </div>

            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>