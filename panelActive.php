<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Accounts</title>
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
            <form class="container manage" action="panelActiveProcess.php" method="post">
                    <div class="links">
                        <a href="panelAdmin.php">Admin Accounts</a>
                    </div>

                <fieldset>
                    <legend>Disable Accounts</legend>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <th>Last Login</th>
                            <th>Type</th>
                            <th>Active</th>
                        </tr>

                        <?php
                        $query = "select * from customers";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            if ($line % 2 == 1) {$style = "style='background: lightgray;'";}
                            else {$style = "";}
                            $line += 1;

                            // disable checkbox if user is admin
                            if (($data['cType'] == 'A' && $data['Active'] == 'active') || $data['cId'] == $_SESSION['CID']) {$d = 'disabled';}
                            else {$d = '';}

                            // check active accounts
                            if ($data['Active'] == 'active') {$a = 'checked';}
                            else {$a = '';}

                            // display admin and normal accounts
                            if ($data['cType'] == 'A') {$type = "Admin";}
                            else {$type = "Normal";}

                            echo "<tr id='clickable' $style>";
                            echo "<td> {$data['cId']} </td>";
                            echo "<td> {$data['cName']} </td>";
                            echo "<td> {$data['email']} </td>";
                            echo "<td> ". fdate($data['registerDate']) ." </td>";
                            echo "<td> ". fdate($data['lastLogin']) ." </td>";
                            echo "<td> $type </td>";
                            echo "<td id='center'> <input type='checkbox' name='box[]' value='{$data['cId']}' $d $a> </td>";
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
                </div>

                <!-- make sure user came from this page -->
                <input type="hidden" name="check">
                
            </form>
        </div>

        <?php include('footer.php'); ?>
        <?php if (isset($_GET["s"])) {echo "<script>notify();</script>";} ?>
    </body>
</html>