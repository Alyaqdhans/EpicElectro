<html>
    <head>
        <?php include('link.php') ?>
        <title>Profile</title>
    </head>
    <body>
        <?php
        include("connect.php");
        include("header.php");
        
        if (!isset($_SESSION['CID'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        }

        $cusId = $_SESSION['CID'];
        $query = "select * from customers where cId='$cusId'";
        $result = mysqli_query($conn, $query);
        $cus = mysqli_fetch_assoc($result);

        ?> 
        <form class="form" method='post' action='profileProcess.php'>
            <div class='main'>
                <fieldset>
                    <legend>Edit Profile</legend>

                    <?php
                        echo "<input type=hidden name='cid' value='{$cus['cId']}'>";
                    ?>

                    <label>Name:</label>
                    <?php
                    echo "<input type=text name='name' value='{$cus['cName']}'>";
                    ?>

                    <label>Email:</label>
                    <?php
                    echo "<input type=text name='email' value='{$cus['email']}'>";
                    ?>

                    <label>Old Password:</label>
                    <?php
                    echo "<input type=password name='passwordOld' value=''>";
                    ?>

                    <label>New Password:</label>
                    <?php
                    echo "<input type=password name='passwordNew' value=''>";
                    ?>

                    <label>New Password (confirm):</label>
                    <?php
                    echo "<input type=password name='passwordConfirm' value=''>";
                    ?>

                    <label>Phone Number:</label>
                    <?php
                    echo "<input type=number name='pnumber' value='{$cus['phoneNumber']}'>";
                    ?>

                    <label>Address:</label>
                    <?php
                    echo "<input type=text name='address' value='{$cus['cAddress']}'>";
                    ?>
                </fieldset>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Save">
                    <input class="btn right" type="reset" value="Reset"> 
                </div>
            </div>
        </form>
        <?php include("footer.php"); ?>
    </body>
</html>