<html>
    <header>
        <title>Login Page</title>
        <link rel="stylesheet" href="../style.css">
        <style>
            body {
                display: flex;
                justify-content: center; /* horizontally */
                align-items: center; /* vertically */
            }

            .main {
                background: white;
                width: fit-content;
                height: fit-content;
                padding: 1rem;
                border-radius: var(--br);
                box-shadow: 0 0 1rem black;
            }

            input {
                display: block;
                padding: .5rem;
                margin: .5rem;
            }

            .buttons {
                display: flex;
                justify-content: center;
                gap: 0.1rem;
            }

            .btn {
                width: fit-content;
                background: var(--clr-secondary);
                padding: .5rem;
                margin: 0;
                border: 0;
                border-radius: var(--br);
                text-decoration: none;
                font-weight: var(--fw-bold);
                font-size: var(--fs-normal);
            }

            .btn:hover {
                background: var(--clr-secondary-light);
            }

            .left {
                border-radius: var(--br) 0 0 var(--br);
            }

            .right {
                border-radius: 0 var(--br) var(--br) 0;
            }
        </style>
    </header>
    <body>
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