<html>
    <header>
        <link rel="stylesheet" href="style.css">
        <title>Profile</title>
    </header>
    <body>
        <?php
        include("connect.php");
        include("header.php");
        
        $cusId = $_SESSION['CID'];
        $query = "select * from customers where cId='$cusId'";
        $request = mysqli_query($conn, $query);
        $cus = mysqli_fetch_assoc($request);

        ?> 
        <form method='post' action='profileProcess.php'>
            <div class='main'>
                <h2>Edit Profile</h2>

                <?php
                    echo "<input type=hidden name='cid' value='{$cus['cId']}'>";
                ?>

                <label>Name: </label>
                <?php
                echo "<input type=text name='name' value='{$cus['cName']}'>";
                ?>

                <label>Password: </label>
                <?php
                echo "<input type=password name='password' value='{$cus['password']}'>";
                ?>

                <label>Email: </label>
                <?php
                echo "<input type=text name='email' value='{$cus['email']}'>";
                ?>

                <label>Address: </label>
                <?php
                echo "<input type=text name='address' value='{$cus['cAddress']}'>";
                ?>

                <label>Phone Number: </label>
                <?php
                echo "<input type=number name='pnumber' value='{$cus['phoneNumber']}'>";
                ?>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Save">
                    <input class="btn right" type="reset" value="Reset"> 
                </div>
            </div>
        </form>
        <?php include("footer.php"); ?>
    </body>
</html>