<html>
    <header>
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="style.css">
    </header>
    <body>
        <?php $file = __FILE__;
        include(dirname(__FILE__).'/../header.php'); ?>
        <form action="process.php" method="post">
            <div class="main">
                <h2>Login</h2>
                <input type="text" placeholder="Username" id="user">
                <input type="password" placeholder="Password" id="pass">
                <div class="buttons">
                    <input class="btn left" type="submit" value="Login">
                    <input class="btn right" type="reset" value="Clear">
                </div>
            </div>
        </form>
    </body>
</html>