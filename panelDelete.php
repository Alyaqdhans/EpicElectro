<html>
    <head>
        <?php include('link.php') ?>
        <title>Deletion</title>
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
            <form class="container manage" action="panelDeleteProcess.php" method="post">
                <fieldset>
                    <legend>Account Deletion</legend>
                    <table>
                        <tr style="background: gray; color: white;">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
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

                            if ($data['cType'] == 'A') {$d = 'disabled';}
                            else {$d = '';}

                            echo "<tr $style>";
                            echo "<td> {$data['cId']} </td>";
                            echo "<td> {$data['cName']} </td>";
                            echo "<td> {$data['email']} </td>";
                            echo "<td id='center'> {$data['cType']} </td>";
                            echo "<td id='center'> <input type='checkbox' name='{$data['cId']}' $d> </td>";
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
                
            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>