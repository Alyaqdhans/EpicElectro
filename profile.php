<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Profile</title>
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
                    echo "<input type='hidden' name='cid' value='{$cus['cId']}' required>";
                    ?>

                    <label>Name:</label>
                    <?php
                    echo "<input type='text' name='name' value='{$cus['cName']}' required>";
                    ?>

                    <label>Email:</label>
                    <?php
                    echo "<input type='email' name='email' value='{$cus['email']}' required>";
                    ?>

                    <label>Old Password:</label>
                    <?php
                    echo "<input type='password' name='passwordOld' value='' required>";
                    ?>

                    <label>New Password:</label>
                    <?php
                    echo "<input type='password' name='passwordNew' value=''>";
                    ?>

                    <label>New Password (confirm):</label>
                    <?php
                    echo "<input type='password' name='passwordConfirm' value=''>";
                    ?>

                    <label>Phone Number:</label>
                    <?php
                    echo "<input type='number' name='pnumber' value='{$cus['phoneNumber']}' required>";
                    ?>

                    <label>Address:</label>
                    <?php
                    echo "<input type='text' name='address' value='{$cus['cAddress']}' required>";
                    ?>
                </fieldset>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Save">
                    <input class="btn right" type="reset" value="Reset"> 
                </div>

            </div>
        </form>
        
        <?php include("footer.php"); ?>
        <?php if (isset($_GET["s"])) {echo "<script>notify();</script>";} ?>
    </body>
</html>