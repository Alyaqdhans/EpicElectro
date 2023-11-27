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
            <form class="container manage" method='post' onsubmit="return confirm('Are you sure you want to do that?');">
                <div class="isearch">
                    <?php echo "<input type='text' name='icode' placeholder='Product ID' value='{$_POST['icode']}'>"; ?>
                    <?php echo "<input type='text' name='iname' placeholder='Product Name' value='{$_POST['iname']}'>"; ?>
                    <input type="submit" value="Search"> 
                </div>
                
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
                        $query = "select * from items where iCode = iCode";
                        $msg = "Found Nothing <br>";
                        
                        if (isset($_POST['icode']) && $_POST['icode'] != "") {
                            $query .= " and iCode = '{$_POST['icode']}'";
                            $msg .= " With ID `{$_POST['icode']}` <br>";
                        }

                        if (isset($_POST['iname']) && $_POST['iname'] != "") {
                            $query .= " and iDesc like '%{$_POST['iname']}%'";
                            $msg .= " With Name `{$_POST['iname']}` <br>";
                        }

                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                        if (mysqli_num_rows($result) > 0) {
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
                        } else {
                            echo "<td colspan=13 id='center' style='font-size: 1.4rem;'>";
                            echo $msg;
                            echo "</td>";
                        }
                        ?>
                    </table>
                </fieldset>
                
                <div class="buttons">
                    <div class="main">
                        <input class="left" type='submit' value='Delete' formaction="panelManageProcess.php">
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