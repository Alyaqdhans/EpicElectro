<?php
session_start();
if (!isset($_SESSION['CID'])) {
    header('Location: error.php?ec=1'); // login required
    exit;
}
?>
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

        <div>
        <form class="form disable" action="profileDisableProcess.php" method="post" onsubmit="loading();">
            <div class="main">
                <fieldset>
                    <legend>Disable Account</legend>
                    
                    <label>
                        Password:<br>
                        <input type="password" name="password" required>
                    </label>

                    <label>
                        <input type="checkbox" id="confirmCheck" onclick="openDisable()">
                        By clicking here, I state and understand that my account will be permanently disabled.
                    </label>
                </fieldset>
                                
                <div class="buttons">
                    <input class="btn left" type="button" id="disableBtn" value="Disable & Logout" onclick="d.showModal();" disabled>
                    <a class="btn right" href="profile.php">Cancel</a>
                </div>

                <dialog class="modal" id="d">
                    <h1>Confirmation</h1>
                    <h2>Are you sure you want to disable the account?</h2>
                    <div class="btns">
                        <input id="sb" type="submit" value="Confirm" onclick="d.close();">
                        <input type="button" value="&times;" onclick="d.close();">
                    </div>
                </dialog>

            </div>
        </form>
        </div>
        
        <?php include('footer.php'); ?>
        <script>openDisable();</script>
    </body>
</html>