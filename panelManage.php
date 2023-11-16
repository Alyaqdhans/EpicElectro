<html>
    <head>
        <?php include('link.php'); 
              include('connect.php');
        ?>
        <title>Management</title>
    </head>
    <body>
        <?php
        include('header.php');

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
            <form class="container manage" action='panelManageDelete.php' method='post'>
                <fieldset>
                    <legend>Item Management</legend>
                    <table clsss="table item">
                        <tr>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Brand</th>
                            <th>Supplier</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    <?php
                    $query = "select * from items";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    
                    while ($data = mysqli_fetch_assoc($result)) {
                        $c = mysqli_fetch_row(mysqli_query($conn, "select categoryDes from categories where categoryCode = {$data['iCategoryCode']}"));
                        $s = mysqli_fetch_row(mysqli_query($conn, "select sName from suppliers where sId = {$data['iSupplierId']}"));
                        echo "<tr>";
                        echo "<td> {$data['iCode']} </td>";
                        echo "<td> {$c[0]} </td>";
                        echo "<td> {$data['iDesc']} </td>";
                        echo "<td> {$data['iQty']} </td>";
                        echo "<td> {$data['iCost']} </td>";
                        echo "<td> {$data['iPrice']} </td>";
                        echo "<td> {$data['iBrand']} </td>";
                        echo "<td> {$s[0]} </td>";
                        echo "<td> <a href=''>Edit</a> </td>";
                        echo "<td> <input type='checkbox' name='{$data['iCode']}' value='{$data['iCode']}'> </td>";
                        echo "</tr>";
                    }
                    ?>
                    </table>
                </fieldset>
                
                <a href='panelManageCreate.php'> Create </a>
                <input type='reset' value='Clear'>
                <input type='submit' value='Delete'>
                
            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>