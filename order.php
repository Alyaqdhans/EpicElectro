<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Orders</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');
        include('library.php');

        if (!isset($_SESSION['CID'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        }
        ?>
        
        <div class="wrapper">
            <div class="container manage">
                <?php
                $query = "select * from orders where cId = {$_SESSION['CID']}";
                $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                if (mysqli_num_rows($result) > 0) {
                ?>
                <fieldset>
                    <legend>Orders History</legend>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Delivery (Name & Contact)</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Items</th>
                        </tr>
                        
                        <?php
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            $name = mysqli_fetch_row(mysqli_query($conn, "select company_name from delivery where dId = {$data['dId']}"));
                            $phone = mysqli_fetch_row(mysqli_query($conn, "select dPhone from delivery where dId = {$data['dId']}"));

                            if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;
                            
                            echo "<tr $style>";
                            echo "<td> {$data['orderId']} </td>";
                            echo "<td> {$name[0]} - {$phone[0]} </td>";
                            echo "<td> ". fdate($data['orderDate']) ." </td>";
                            echo "<td>". number_format($data['totalPrice']) ."</td>";
                            echo "<td id='center'> <a href='orderView.php?oid={$data['orderId']}'> View </a> </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </fieldset>
                <?php
                } else {
                    echo "<h2> You Have No Orders To Display </h2>";
                }
                ?>

            </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>