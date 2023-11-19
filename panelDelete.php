<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Deletion</title>
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
            <form class="container manage" action="panelDeleteProcess.php" method="post" onsubmit="return confirm('Are you sure you want to do that?');">
                <fieldset>
                    <legend>Delete Accounts</legend>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <th>Type</th>
                            <th>Delete</th>
                        </tr>

                        <?php
                        $query = "select * from customers";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;

                            if ($data['cType'] == 'A' || $data['cId'] == $_SESSION['CID']) {$d = 'disabled';}
                            else {$d = '';}

                            if ($data['cType'] == 'A') {$type = "Admin";}
                            else {$type = "Normal";}

                            echo "<tr id='clickable' $style>";
                            echo "<td> {$data['cId']} </td>";
                            echo "<td> {$data['cName']} </td>";
                            echo "<td> {$data['email']} </td>";
                            $date = explode("-", $data['registerDate']);
                            $date = $date[2]."/".$date[1]."/".$date[0];
                            echo "<td> $date </td>";
                            echo "<td> $type </td>";
                            echo "<td id='center'> <input type='checkbox' name='box[]' value='{$data['cId']}' $d> </td>";
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
                </div>

                <!-- make sure user came from this page -->
                <input type="hidden" name="check">
                
            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>