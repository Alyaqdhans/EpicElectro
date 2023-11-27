<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Suppliers</title>
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
            <form class="container manage" action='panelSupplierProcess.php' method='post'>
                <fieldset>
                    <legend>Supplier Management</legend>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        
                        <?php
                        $query = "select * from suppliers";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;

                            if (mysqli_num_rows($result) == 1) {$d = "disabled";}
                            else {$d = "";}
                            
                            echo "<tr id='clickable' $style>";
                            echo "<td> {$data['sId']} </td>";
                            echo "<td> {$data['sName']} </td>";
                            echo "<td> {$data['sPhone']} </td>";
                            echo "<td> {$data['sEmail']} </td>";
                            echo "<td id='center'> <a href='panelSupplierView.php?sid={$data['sId']}'> View </a> </td>";
                            echo "<td id='center'> <a href='panelSupplierEdit.php?sid={$data['sId']}'> Edit </a> </td>";
                            echo "<td id='center'> <input type='checkbox' name='box[]' value='{$data['sId']}' $d> </td>";
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
                    <a href='panelSupplierNew.php'> New </a>
                </div>

                <h4>*Deleting a supplier that is in a product,
                    will change the product's supplier to another one.</h4>

                <!-- make sure user came from this page -->
                <input type="hidden" name="check">

            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>