<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Items</title>
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
            <div class="container manage address">
                <fieldset>
                    <legend>Items</legend>

                    <table clsss="table item">
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        
                        <?php
                        $query = "select * from order_items where orderID = {$_GET['oid']}";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));                    
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            $item = mysqli_fetch_row(mysqli_query($conn, "select iDesc, iBrand, iPrice from items where iCode = {$data['iCode']}"));

                            if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;
                            
                            echo "<tr $style>";
                            echo "<td> {$item[0]} </td>";
                            echo "<td> {$item[1]} </td>";
                            echo "<td> {$item[2]} </td>";
                            echo "<td id='center'> {$data['quantity']} </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </fieldset>

                <div class="buttons">
                    <a href='order.php'> Back </a>
                </div>

            </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>