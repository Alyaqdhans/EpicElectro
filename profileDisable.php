<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Profile</title>
    </head>
    <body>
        <?php
        include('header.php'); 
        include("connect.php");
        ?>
        <form class="form disable" action="ProfileDisableProcess.php" method="post">
            <div class="main">
                <fieldset>
                    <legend>Disable Account</legend>
                    
                    <label>
                        Current Password:<br>
                        <input type="password" name="password" required>
                    </label>

                    <label>
                        <input type="checkbox" onclick="openDisable()">
                        By clicking here, I state and understand that my account will be permanently disabled.
                    </label>
                </fieldset>
                                
                <div class="buttons">
                    <input class="btn left" type="submit" id="disable" value="Disable & Logout" disabled>
                    <a class="btn right" href="profile.php">Cancel</a>
                </div>
            </div>
        </form>
        <?php include('footer.php'); ?>
    </body>
</html>