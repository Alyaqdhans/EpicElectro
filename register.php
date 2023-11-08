<html>
    <header>
        <link rel="stylesheet" href="style.css">
        <title>Register</title>
    </header>
    <body>
        <?php
        include('header.php'); 
        include("connect.php");
        ?>
        <form action="RegisterProcess.php" method="post">
            <div class="main">
                <h2>Register</h2>

                <label>Email: </label>
                <input type="text" name="email">
                
                <label>Name: </label>
                <input type="text" name="name">
                
                <label>Phone Number: </label>
                <input type="number" name="pnumber">
                
                <label>Password: </label>
                <input type="password" name="password">
                
                <label>Address: </label>
                <input type="text" name="address">
                
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