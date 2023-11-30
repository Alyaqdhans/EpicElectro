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

                    <!-- hidden input -->
                    <?php echo "<input type='hidden' name='cid' value='{$cus['cId']}' required>"; ?>

                    <label>
                        Name:<br>
                        <?php echo "<input type='text' name='name' value='{$cus['cName']}' required>"; ?>
                    </label>

                    <label>
                        Email:<br>
                        <?php echo "<input type='email' name='email' value='{$cus['email']}' required>"; ?>
                    </label>

                    <label>
                        Current Password:<br>
                        <?php echo "<input type='password' name='password' value='' required>"; ?>
                    </label>

                    <label>
                        New Password:<br>
                        <?php echo "<input type='password' name='passwordNew' value=''>"; ?>
                    </label>

                    <label>
                        New Password (confirm):<br>
                        <?php echo "<input type='password' name='passwordConfirm' value=''>"; ?>
                    </label>

                    <label>
                        Phone Number:<br>
                        <?php echo "<input type='number' name='pnumber' value='{$cus['phoneNumber']}' required>"; ?>
                    </label>

                    <label>
                        Address:<br>
                        <?php echo "<input type='text' name='address' value='{$cus['cAddress']}' required>"; ?>
                    </label>
                </fieldset>

                <h4>Disable your account? <a href="profileDisable.php">Click Here</a></h4>

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