<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Panel</title>
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
            <div class="container manage">
                <fieldset>
                    <legend>Management</legend>

                    <div class="links">
                        <a href="panelDelete.php">Accounts</a>
                        <a href="panelManage.php">Items</a>
                        <a href="panelSupplier.php">Suppliers</a>
                    </div>
                </fieldset>

                <?php
                $query = "select * from orders order by orderDate desc";
                $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                if (mysqli_num_rows($result) > 0) {
                ?>
                <fieldset class="activity">
                    <legend>Latest Orders</legend>

                    <table>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Items</th>
                        </tr>
                        
                        <?php
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            $name = mysqli_fetch_row(mysqli_query($conn, "select cName from customers where cId = {$data['cId']}"));
                            $email = mysqli_fetch_row(mysqli_query($conn, "select email from customers where cId = {$data['cId']}"));

                            if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;
                            
                            echo "<tr $style>";
                            echo "<td id='center'> {$data['orderId']} </td>";
                            echo "<td id='center'> ". explode(" ", $name[0])[0] ." </td>";
                            echo "<td id='center'> {$email[0]} </td>";
                            $date = explode("-", $data['orderDate']);
                            $date = $date[2]."/".$date[1]."/".$date[0];
                            echo "<td> $date </td>";
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