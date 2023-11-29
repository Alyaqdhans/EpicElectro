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
            <form class="container manage" method='post'>
                <div class="isearch">
                    <?php
                    if (isset($_POST['icode'])) {$cd = $_POST['icode'];}
                    else {$cd = "";}
                    if (isset($_POST['iname'])) {$nm = $_POST['iname'];}
                    else {$nm = "";}
                    echo "<input type='text' name='icode' placeholder='Product ID' value='$cd'>";
                    echo "<input type='text' name='iname' placeholder='Product Name' value='$nm'>";
                    ?>
                    <input type="submit" value="Search" formaction="panelManage.php"> 
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
                            <th>Active</th>
                        </tr>
                        
                        <?php
                        $query = "select * from items where iCode = iCode";
                        $msg = "Database is empty";

                        if (isset($_POST['icode']) || isset($_POST['iname'])) {
                            $msg = "Found nothing <br>";
                        }
                        
                        if (isset($_POST['icode']) && $_POST['icode'] != "") {
                            $query .= " and iCode = '{$_POST['icode']}'";
                            $msg .= " with ID `{$_POST['icode']}` <br>";
                        }

                        if (isset($_POST['iname']) && $_POST['iname'] != "") {
                            $query .= " and iDesc like '%{$_POST['iname']}%'";
                            $msg .= " with name `{$_POST['iname']}` <br>";
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

                                if ($data['Active'] == 'active') {$a = 'checked';}
                                else {$a = '';}
                                
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
                                echo "<td id='center'> <input type='checkbox' name='box[]' value='{$data['iCode']}' $a> </td>";
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
                        <input class="left" type='submit' value='Save' formaction="panelManageProcess.php">
                        <input class="right" type='reset' value='Discard'>
                    </div>
                    <a href='panelManageCreate.php'> Create </a>
                </div>

                <!-- make sure user came from this page -->
                <input type="hidden" name="check">
                
            </form>
        </div>

        <?php include('footer.php'); ?>
        <?php if (isset($_GET["s"])) {echo "<script>notify();</script>";} ?>
    </body>
</html>