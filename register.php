<?php session_start(); ?>
<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Register</title>
    </head>
    <body>
        <?php
        include('header.php'); 
        include("connect.php");
        ?>
        <form class="form" action="registerProcess.php" method="post" onsubmit="loading();">
            <div class="main">
                <fieldset>
                    <legend>Register</legend>

                    <label>
                        Name:<br>
                        <input type="text" name="name" required>
                    </label>
                    
                    <label>
                        Email:<br>
                        <input type="email" name="email" required>
                    </label>
                    
                    <label>
                        Password:<br>
                        <input type="password" name="password" required>
                    </label>

                    <label>
                        Password (confirm):<br>
                        <input type="password" name="passwordConfirm" required>
                    </label>
                    
                    <label>
                        Phone Number:<br>
                        <input type="number" name="pnumber" required>
                    </label>
                    
                    <label>
                        Address:<br>
                        <input type="text" name="address" required>
                    </label>
                </fieldset>
                
                <h4>Do you have an account? <a href="login.php">Login</a></h4>
                
                <div class="buttons">
                    <input id="sb" class="btn left" type="submit" value="Register">
                    <input class="btn right" type="reset" value="Clear">
                </div>
            </div>
        </form>
        <?php include('footer.php'); ?>
    </body>
</html>