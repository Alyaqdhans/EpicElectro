<?php session_start(); ?>
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
                <section>
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

                    <div class="ifilter">
                        <?php
                        $query = "select iBrand from items where iDesc != 'new' group by iBrand";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        echo "<select name='brand'>";
                        echo "<option value=''> Brands </option>";
                        while ($data = mysqli_fetch_assoc($result)) {
                            if (isset($_POST['brand']) && $data['iBrand'] == $_POST['brand']) {$select = "selected";}
                            else {$select = "";}
                            $content = mysqli_num_rows(mysqli_query($conn, "select * from items where iBrand = '{$data['iBrand']}'"));
                            echo "<option value='{$data['iBrand']}' $select> {$data['iBrand']} ($content) </option>";
                        }
                        echo "</select>";

                        
                        $query = "select * from categories";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        $categories = [];
                        echo "<select name='category'>";
                        echo "<option value=''> Categories </option>";
                        while ($data = mysqli_fetch_assoc($result)) {
                            if (isset($_POST['category']) && $data['categoryCode'] == $_POST['category']) {$select = "selected";}
                            else {$select = "";}
                            $categories[] = $data['categoryDes'];
                            $content = mysqli_num_rows(mysqli_query($conn, "select * from items where iCategoryCode = {$data['categoryCode']}"));
                            echo "<option value={$data['categoryCode']} $select> {$data['categoryDes']} ($content) </option>";
                        }
                        echo "</select>";

                        
                        $query = "select * from suppliers";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        $suppliers = [];
                        echo "<select name='supplier'>";
                        echo "<option value=''> Suppliers </option>";
                        while ($data = mysqli_fetch_assoc($result)) {
                            if (isset($_POST['supplier']) && $data['sId'] == $_POST['supplier']) {$select = "selected";}
                            else {$select = "";}
                            $suppliers[] = $data['sName'];
                            $content = mysqli_num_rows(mysqli_query($conn, "select * from items where iSupplierId = {$data['sId']}"));
                            echo "<option value={$data['sId']} $select> {$data['sName']} ($content) </option>";
                        }
                        echo "</select>";


                        $sorts = ["iDesc"=>"Name", "iCost"=>"Cost", "iPrice"=>"Price", "iLastPurchasedDate"=>"Last Supplied", "iSold"=>"Sold", "iQty"=>"Quantity"];
                        echo "<select name='sort'>";
                            echo "<option value='iCode'>Sort By</option>";
                            foreach ($sorts as $key => $value) {
                                if (isset($_POST['sort']) && $key == $_POST['sort']) {$select = "selected";}
                                else {$select = "";}
                                echo "<option value='$key' $select>$value</option>";
                            }
                        echo "</select>";

                        if (isset($_POST['order']) && $_POST['order'] == "desc") {$desc = "checked"; $asc = "";}
                        else {$desc = ""; $asc = "checked";}
                        echo "<div class='radio'>";
                            echo "<label><input type='radio' name='order' value='asc' $asc>Ascending</label>";
                            echo "<label><input type='radio' name='order' value='desc' $desc>Descending</label>";
                        echo "</div>";
                        ?>

                    </div>
                </section>
                
                <fieldset>
                    <legend>Product Management</legend>

                    <table>
                        <tr>
                            <?php
                            $heads = ["iCode"=>"ID", "iDesc"=>"Name", "iBrand"=>"Brand", "iCategoryCode"=>"Category", "iCost"=>"Cost",
                            "iPrice"=>"Price", "iSupplierId"=>"Supplier", "iLastPurchasedDate"=>"Last Supplied", "iSold"=>"Sold", "iQty"=>"Quantity"];
                            foreach ($heads as $key => $value) {
                                if (isset($_POST['order']) && $_POST['order'] == "desc") {$a = "▼";}
                                else {$a = "▲";}
                                if (isset($_POST['sort']) && $key == $_POST['sort']) {$arrow = $a;}
                                else {$arrow = "";}
                                echo "<th>$arrow$value$arrow</th>";
                            }
                            ?>
                            <th>Stock</th>
                            <th>Edit</th>
                            <th>Active</th>
                        </tr>
                        
                        <?php
                        $query = "select * from items where iCode = iCode";
                        $msg = "Database is empty";

                        if (isset($_POST['icode']) || isset($_POST['iname']) || isset($_POST['brand']) || isset($_POST['category']) || isset($_POST['supplier'])) {
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

                        if (isset($_POST['brand']) && $_POST['brand'] != "") {
                            $query .= " and iBrand = '{$_POST['brand']}'";
                            $msg .= " in brand `{$_POST['brand']}` <br>";
                        }

                        if (isset($_POST['category']) && $_POST['category'] != "") {
                            $query .= " and iCategoryCode = {$_POST['category']}";
                            $msg .= " in category `{$categories[$_POST['category']-1]}` <br>";
                        }

                        if (isset($_POST['supplier']) && $_POST['supplier'] != "") {
                            $query .= " and iSupplierId = {$_POST['supplier']}";
                            $msg .= " in supplier `{$suppliers[$_POST['supplier']-1]}` <br>";
                        }

                        if (isset($_POST['sort'])) {$sort = $_POST['sort'];}
                        else {$sort = "iCode";}
                        
                        if (isset($_POST['order'])) {$order = $_POST['order'];}
                        else {$order = "asc";}

                        $query .= " order by $sort $order";


                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                        if (mysqli_num_rows($result) > 0) {
                            $line = 0;
                            while ($data = mysqli_fetch_assoc($result)) {
                                if ($data['iDesc'] == "new") {continue;}

                                $category = mysqli_fetch_row(mysqli_query($conn, "select categoryDes from categories where categoryCode = {$data['iCategoryCode']}"));
                                $supplier = mysqli_fetch_row(mysqli_query($conn, "select sName from suppliers where sId = {$data['iSupplierId']}"));

                                if ($line % 2 == 1 && $data['iQty'] == 0) {$style = "style='background: var(--gray); color: var(--red);'";}
                                else if ($line % 2 == 0 && $data['iQty'] == 0) {$style = "style='color: var(--red);'";}
                                else if ($line % 2 == 1) {$style = "style='background: var(--gray);'";}
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