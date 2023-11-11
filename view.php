<html>
    <head>
        <?php include('link.php'); ?>
        <title>View</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');
        ?>


        <?php
            $query = "select * from items where iCode={$_GET['ic']}";
            $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
            $data = mysqli_fetch_assoc($result); 
        ?>
            <div>

                <img href="" alt="">
                <?php
                    echo "<h3>Title: {$data['iDesc']}</h3>";
                ?>

            </div>

        <?php
            include("footer.php");
        ?>
    </body>
</html>