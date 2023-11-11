<html>
    <head>
        <?php include('link.php'); ?>
        <title>Home</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');
        ?>
        
        <form class="grid" action="search.php" method="post">
            <section class="top">
                <input type=text name="search" >
                <!-- Drop box (category) -->
                <?php
                    echo "<select name=cat >";
                        echo "<option value=x>Choose categories</option>";
                    $query = "select * from categories";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    while ($data = mysqli_fetch_assoc($result)){
                        echo "<option vlaue='{$data['categoryCode']}'>{$data['categoryDes']}</option>";
                    }
                    echo "</select>";
                ?>
                <input type="submit" vlaue="search">
                <a href="cart.php">cart</a>
                <div></div>
            </section>

            <!-- item cards -->
            <?php 
                $query = "select * from items";
                $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                $r = mysqli_num_rows($result);
                while ($data = mysqli_fetch_assoc($result)){
                    echo "<div class='card'>";
                        echo "<img src='images/{$data['iCode']}.jpg' alt='Item Image'>";
                        echo "<h3>{$data['iDesc']}</h3>";
                        echo "<h4>by {$data['iBrand']}</h4>";
                        echo "<a href='view.php?ic={$data['iCode']}'>view</a>";
                    echo "</div>";
                }
            ?>
            
            <!-- item brands -->
            <!-- <div>
            <?php
                // $query = "select iBrand from items";
                // $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                // echo "<ul>";
                // while ($data = mysqli_fetch_assoc($result)){
                //     echo "<li>{$data['iBrand']}</li>";
                // }
                // echo "</ul>";
            ?>
            </div> -->
        </form>
            
        <?php include('footer.php'); ?>
    </body>
</html>