<html>
    <head>
        <?php include('link.php') ?>
        <title>Deletion</title>
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
            <div class="container">
                <fieldset>
                    <legend>Account Deletion</legend>
                    <table clsss="table">
                        <tr>
                            <th>customer ID</th>
                            <th>customer Name</th>
                            <th>Email</th>
                            <th>custtomer type</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $query = "select * from customers";
                        $result = mysqli_query($conn,$query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo "<tr> <label>";
                            echo "<td> {$data['cId']} </td>";
                            echo "<td> {$data['cName']} </td>";
                            echo "<td> {$data['email']} </td>";
                            echo "<td> {$data['cType']} </td>";
                            echo "<td> <a href=''>Edit</a> </td>";
                            echo "<td><input type='checkbox' name= value={$data['cId']}> </td>";
                            echo "</label> </tr>";
                        }
                        ?>
                    </table>
                </fieldset>
                
                <input type='submit' value='Delete'>
                <input type='reset' value='Clear'>
                </fieldset>
            </div>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>