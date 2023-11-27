<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Couriers</title>
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
            <form class="container manage" action='panelDeliveryProcess.php' method='post'>
                <fieldset>
                    <legend>Courier Management</legend>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        
                        <?php
                        $query = "select * from delivery";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;

                            if (mysqli_num_rows($result) == 1) {$d = "disabled";}
                            else {$d = "";}
                            
                            echo "<tr id='clickable' $style>";
                            echo "<td> {$data['dId']} </td>";
                            echo "<td> {$data['company_name']} </td>";
                            echo "<td> {$data['dPhone']} </td>";
                            echo "<td id='center'> <a href='panelDeliveryEdit.php?did={$data['dId']}'> Edit </a> </td>";
                            echo "<td id='center'> <input type='checkbox' name='box[]' value='{$data['dId']}' $d> </td>";
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
                    <a href='panelDeliveryNew.php'> New </a>
                </div>

                <h4>*Deleting a courier that is in an order,
                    will change the order's courier to another one.</h4>

                <!-- make sure user came from this page -->
                <input type="hidden" name="check">

            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>