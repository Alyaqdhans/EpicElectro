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
        
        <form class="top" action="search.php" method="post">
            <div class="search">
                <input type=text name="search" placeholder="Search for Items">
                <input type="submit" value="Search">
                
                <!-- Drop box (category) -->
                <?php
                    echo "<select name=cat >";
                        echo "<option value='x'>Choose Categories</option>";
                    $query = "select * from categories";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    while ($data = mysqli_fetch_assoc($result)){
                        echo "<option vlaue='{$data['categoryCode']}'>{$data['categoryDes']}</option>";
                    }
                    echo "</select>";
                ?>
            </div>

            <div class="cart">
                <a href="cart.php">Cart</a>
                <span>0</span>
            </div>
        </form>

        <!-- item cards -->
        <section class="grid">
            <?php 
                $query = "select * from items";
                $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                $r = mysqli_num_rows($result);
                while ($data = mysqli_fetch_assoc($result)){
                    echo "<div class='card'>";
                        echo "<img src='images/{$data['iCode']}.jpg' alt='Item Image'>";
                        echo "<h3>{$data['iDesc']}</h3>";
                        echo "<h4>by {$data['iBrand']}</h4>";
                        echo "<a href='view.php?ic={$data['iCode']}'>View</a>";
                    echo "</div>";
                }
            ?>
        </section>
            
        <?php include('footer.php'); ?>
    </body>
</html>