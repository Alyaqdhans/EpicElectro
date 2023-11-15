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
                <?php
                if (!empty($_POST['search'])) {$s = $_POST['search'];}
                else {$s = '';}

                echo "<input id='search' type=text name='search' placeholder='Search for Items' value='$s'>";
                ?>
                <input type="submit" value="Search">

                <?php
                if (isset($_POST['category']) && $_POST['category'] != 'x') {
                    $category = $_POST['category'];
                } else {
                    $category = '';
                }

                echo "<select name='category'>";
                    echo "<option value='x'> Choose Categories </option>";

                    $query = "select * from categories";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                    while ($data = mysqli_fetch_assoc($result)) {
                        if ($data['categoryCode'] == $category) {$c = 'selected';}
                        else {$c = '';}

                        echo "<option value='{$data['categoryCode']}' $c> {$data['categoryDes']} </option>";
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
            if (empty($_POST['search']) && (!isset($_POST['category']) || $_POST['category'] == 'x')) {
                $query = "select * from items";
                $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                
                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_assoc($result)) {
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
                } else {
                    echo "<div class='nothing'>";
                        echo "<h2> Database Is Empty </h2>";
                    echo "</div>";
                }
            } else { // user searched for something
                $query = "select * from items where iCode = iCode";

                if (!empty($_POST['search'])) {
                    $query .= " and iDesc like '%{$_POST['search']}%'";
                }

                if ($_POST['category'] != 'x') {
                    $query .= " and iCategoryCode = '{$_POST['category']}'";
                }

                $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                
                if (mysqli_num_rows($result)> 0) {

                    while ($data = mysqli_fetch_assoc($result)) {
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
                } else {
                    echo "<div class='nothing'>";
                        echo "<h2> No Items Found </h2>";
                    echo "</div>";
                }
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