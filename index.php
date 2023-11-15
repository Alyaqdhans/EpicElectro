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
        
        <form class="top" method="post">
            <div class="search">
                <input type=text name="search" placeholder="Search for Items">
                <input type="submit" value="Search">

                <?php
                echo "<select name=cat >";
                    echo "<option value='x'>Choose Categories</option>";
                $query = "select * from categories";
                $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                while ($data = mysqli_fetch_assoc($result)){
                    echo "<option vlaue='{$data['categoryCode']}'> {$data['categoryDes']} </option>";
                }
                echo "</select>";
                ?>
            </div>

            <div class="cart">
                <a href="cart.php">Cart</a>
                <span>
                    <?php
                    if (isset($_SESSION['CART'])) {
                        echo count($_SESSION['CART']);
                    } else {
                        echo 0;
                    }
                    ?>
                </span>
            </div>
        </form>

        <section class="grid">
            <?php 
            $query = "select * from items";
            $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
            $r = mysqli_num_rows($result);
            while ($data = mysqli_fetch_assoc($result)){
                echo "<div class='card'>";
                    echo "<img src='images/{$data['iCode']}.jpg' alt='Image'>";
                    echo "<h3> {$data['iDesc']} </h3>";
                    echo "<h4> by {$data['iBrand']} </h4>";
                    if ($data['iQty'] > 0) {
                        echo "<h5> Available: ✅ </h5>";
                    } else {
                        echo "<h5> Available: ❌ </h5>";
                    }
                    echo "<a href='view.php?ic={$data['iCode']}'> View </a>";
                    echo "<span class='anchor' id='{$data['iCode']}'></span>"; // scrolls user back
                echo "</div>";
            }
            ?>
        </section>
        
        <div class="scroll">
            <a class="btn up" href="#up">▲</a>
            <a class="btn down" href="#down">▼</a>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>