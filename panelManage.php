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
            <form class="container manage" action='panelManageProcess.php' method='post'>
                <fieldset>
                    <legend>Item Management</legend>
                    <table clsss="table item">
                        <tr style="background: gray; color: white;">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                            <th>Add</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $query = "select * from items";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            $c = mysqli_fetch_row(mysqli_query($conn, "select categoryDes from categories where categoryCode = {$data['iCategoryCode']}"));
                            $s = mysqli_fetch_row(mysqli_query($conn, "select sName from suppliers where sId = {$data['iSupplierId']}"));

                            if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;
                            
                            echo "<tr $style>";
                            echo "<td> {$data['iCode']} </td>";
                            echo "<td> {$data['iDesc']} </td>";
                            echo "<td> {$data['iBrand']} </td>";
                            echo "<td> {$c[0]} </td>";
                            echo "<td> {$data['iCost']} </td>";
                            echo "<td> {$data['iPrice']} </td>";
                            echo "<td> {$s[0]} </td>";
                            echo "<td id='center'> {$data['iQty']} </td>";
                            echo "<td> <a href='panelManageAdd.php'> Add </a> </td>";
                            echo "<td> <a href='panelManageEdit.php'> Edit </a> </td>";
                            echo "<td id='center'> <input type='checkbox' name='{$data['iCode']}'> </td>";
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
                
            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>