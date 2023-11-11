<html>
    <head>
        <?php include('link.php') ?>
        <title>Register</title>
    </head>
    <body>
        <?php
        include('header.php'); 
        include("connect.php");
        ?>
        <form class="form" action="RegisterProcess.php" method="post">
            <div class="main">
                <fieldset>
                    <legend>Register</legend>

                    <label>Name:</label>
                    <input type="text" name="name">
                    
                    <label>Email:</label>
                    <input type="text" name="email">
                    
                    <label>Password:</label>
                    <input type="password" name="password">

                    <label>Password (confirm):</label>
                    <input type="password" name="passwordConfirm">
                    
                    <label>Phone Number:</label>
                    <input type="number" name="pnumber">
                    
                    <label>Address:</label>
                    <input type="text" name="address">
                </fieldset>
                
                <h4>Do you have an account? <a href="login.php">Login</a></h4>
                
                <div class="buttons">
                    <input class="btn left" type="submit" value="Register">
                    <input class="btn right" type="reset" value="Clear">
                </div>
            </div>
        </form>
        <?php include('footer.php'); ?>
    </body>
</html>