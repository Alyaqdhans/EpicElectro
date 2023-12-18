<?php
session_start();
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
        ?>
        
        <div>
        <div class="wrapper">
            <form class="container manage" action="panelAccountProcess.php" method="post">
                <fieldset>
                    <legend>Account Management</legend>

                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <th>Last&nbsp;Login</th>
                            <th>Type</th>
                            <th>Active</th>
                        </tr>

                        <?php
                        $query = "select * from customers";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        $line = 0;
                        while ($data = mysqli_fetch_assoc($result)) {
                            // check active accounts
                            if ($data['Active'] == 'active') {$a = 'checked';}
                            else {$a = '';}

                            // disable checkbox if user is admin
                            if (($data['cType'] == 'A' && $data['Active'] == 'active') || $data['cId'] == $_SESSION['CID']) {$d = 'disabled';}
                            else {$d = '';}
                            
                            // alternate table rows color
                            if ($line % 2 == 1) {$styles = "background: var(--gray);";}
                            else {$styles = "";}
                            $line += 1;

                            // dont allow current user to remove their admin and color them
                            if ($data['cId'] == $_SESSION['CID']) {
                                $s = 'disabled';
                                $styles .= "color: var(--accent);";
                            } else {
                                $s = '';
                            }

                            echo "<tr id='clickable' style='$styles'>";
                            echo "<td> {$data['cId']} </td>";
                            echo "<td> {$data['cName']} </td>";
                            echo "<td> {$data['email']} </td>";
                            echo "<td> ". fdate($data['registerDate']) ." </td>";
                            echo "<td> ". fdateTime($data['lastLogin']) ." </td>";
                            echo "<td>";
                                echo "<select name='type[]' $s>";
                                    if ($data['cType'] == 'A') {$admin = "selected"; $normal = "";}
                                    else {$admin = ""; $normal = "selected";}
                                    echo "<option value='{$data['cId']} A' $admin> Admin </option>";
                                    echo "<option value='{$data['cId']} N' $normal> Normal </option>";
                                echo "</select>";
                            echo "</td>";
                            echo "<td id='center'> <input type='checkbox' name='box[]' value='{$data['cId']}' $d $a> </td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </fieldset>
                
                <div class="buttons">
                    <div class="main">
                        <input class="left" type='submit' value='Save'>
                        <input class="right" type='reset' value='Discard' onclick="notify('Changes Have Been Discarded', 'darkcyan');">
                    </div>
                </div>

                <!-- make sure user came from this page -->
                <input type="hidden" name="check">
                
            </form>
        </div>
        </div>

        <?php include('footer.php'); ?>
        <?php if (isset($_GET["s"])) {echo "<script>notify();</script>";} ?>
    </body>
</html>