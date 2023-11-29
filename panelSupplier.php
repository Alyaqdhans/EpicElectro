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
                            <th>Active</th>
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

                            if ($data['Active'] == 'active') {$a = 'checked';}
                            else {$a = '';}
                            
                            echo "<tr id='clickable' $style>";
                            echo "<td> {$data['sId']} </td>";
                            echo "<td> {$data['sName']} </td>";
                            echo "<td> {$data['sPhone']} </td>";
                            echo "<td> {$data['sEmail']} </td>";
                            echo "<td id='center'> <a href='panelSupplierView.php?sid={$data['sId']}'> View </a> </td>";
                            echo "<td id='center'> <a href='panelSupplierEdit.php?sid={$data['sId']}'> Edit </a> </td>";
                            echo "<td id='center'> <input type='checkbox' name='box[]' value='{$data['sId']}' $d $a> </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </fieldset>
                
                <div class="buttons">
                    <div class="main">
                        <input class="left" type='submit' value='Save'>
                        <input class="right" type='reset' value='Discard'>
                    </div>
                    <a href='panelSupplierNew.php'> New </a>
                </div>

                <!-- make sure user came from this page -->
                <input type="hidden" name="check">

            </form>
        </div>

        <?php include('footer.php'); ?>
        <?php if (isset($_GET["s"])) {echo "<script>notify();</script>";} ?>
    </body>
</html>