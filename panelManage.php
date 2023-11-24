<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Products</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');
        include('library.php');

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
            <form class="container manage" action='panelManageProcess.php' method='post' onsubmit="return confirm('Are you sure you want to do that?');">
                <fieldset>
                    <legend>Product Management</legend>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Supplier</th>
                            <th>Last Supplied</th>
                            <th>Sold</th>
                            <th>Quantity</th>
                            <th>Stock</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        
                        <?php
                        $query = "select * from items";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            if ($data['iDesc'] == "new") {continue;}

                            $category = mysqli_fetch_row(mysqli_query($conn, "select categoryDes from categories where categoryCode = {$data['iCategoryCode']}"));
                            $supplier = mysqli_fetch_row(mysqli_query($conn, "select sName from suppliers where sId = {$data['iSupplierId']}"));

                            if ($line % 2 == 1 && $data['iQty'] == 0) {$style = "style='background: lightgray; color: red;'";}
                            else if ($line % 2 == 0 && $data['iQty'] == 0) {$style = "style='color: red;'";}
                            else if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;
                            
                            echo "<tr id='clickable' $style>";
                            echo "<td> {$data['iCode']} </td>";
                            echo "<td> {$data['iDesc']} </td>";
                            echo "<td> {$data['iBrand']} </td>";
                            echo "<td> {$category[0]} </td>";
                            echo "<td> {$data['iCost']} </td>";
                            echo "<td> {$data['iPrice']} </td>";
                            echo "<td> {$supplier[0]} </td>";
                            echo "<td> ". fdate($data['iLastPurchasedDate']) ." </td>";
                            echo "<td id='center'> {$data['iSold']} </td>";
                            echo "<td id='center'> {$data['iQty']} </td>";
                            echo "<td id='center'> <a href='panelManageAdd.php?ic={$data['iCode']}'> Add </a> </td>";
                            echo "<td id='center'> <a href='panelManageEdit.php?ic={$data['iCode']}'> Edit </a> </td>";
                            echo "<td id='center'> <input type='checkbox' name='box[]' value='{$data['iCode']}'> </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </fieldset>
                
                <div class="buttons">
                    <div class="main">
                        <input class="left" type='submit' value='Delete'>
                        <input class="right" type='reset' value='Clear'>
                    </div>
                    <a href='panelManageCreate.php'> Create </a>
                </div>

                <h4>*Deleting a product that is in an order,
                    will delete the product from the order's list.</h4>

                <!-- make sure user came from this page -->
                <input type="hidden" name="check">
                
            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>