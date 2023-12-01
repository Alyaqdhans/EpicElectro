<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Orders</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');

        if (!isset($_SESSION['CID'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        }
        ?>
        
        <div class="wrapper">
            <div class="container manage address">
                <fieldset>
                    <legend>Order Items</legend>

                    <table clsss="table item">
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <!-- <th>Total</th> -->
                        </tr>
                        
                        <?php
                        $query = "select * from order_items where orderID = {$_GET['oid']}";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));                    
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            $item = mysqli_fetch_row(mysqli_query($conn, "select iDesc, iBrand, iPrice from items where iCode = {$data['iCode']}"));
                            $name = $item[0];
                            $brand = $item[1];
                            $price = $item[2];
                            $total = $item[2] * $data['quantity'];

                            if ($line % 2 == 1) {$style = "style='background: var(--gray);'";}
                            else {$style = "";}
                            $line += 1;
                            
                            echo "<tr $style>";
                            echo "<td> $name </td>";
                            echo "<td> $brand </td>";
                            echo "<td> ". number_format($price) ." </td>";
                            echo "<td id='center'> {$data['quantity']} </td>";
                            // echo "<td> ". number_format($total) ." </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </fieldset>

                <div class="buttons">
                    <a href='javascript:history.back()'> Back </a>
                </div>

            </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>