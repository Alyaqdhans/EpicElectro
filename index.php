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
                echo "<select name='category'>";
                    echo "<option value='x'> Categories </option>";

                    $query = "select * from categories";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    
                    if (isset($_POST['category']) && $_POST['category'] != 'x') {
                        $category = $_POST['category'];
                    } else {
                        $category = '';
                    }

                    $categories = [];
                    while ($data = mysqli_fetch_assoc($result)) {
                        $categories[] = $data['categoryDes'];

                        if ($data['categoryCode'] == $category) {$c = 'selected';}
                        else {$c = '';}

                        echo "<option value='{$data['categoryCode']}' $c> {$data['categoryDes']} </option>";
                    }
                echo "</select>";

                echo "<select name='brand'>";
                    echo "<option value='x'> Brands </option>";

                    $query = "select iBrand from items group by iBrand";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                    if (isset($_POST['brand']) && $_POST['brand'] != 'x') {
                        $brand = $_POST['brand'];
                    } else {
                        $brand = '';
                    }

                    $brands = [];
                    $i = 0;
                    while ($data = mysqli_fetch_assoc($result)) {
                        $brands[] = $data['iBrand'];
                        
                        if ($i == $brand) {$c = 'selected';}
                        else {$c = '';}

                        echo "<option value='$i' $c> {$data['iBrand']} </option>";
                        $i++;
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
            $query = "select * from items where iCode = iCode";
            $msg = "Found Nothing <br>";

            if (
                empty($_POST['search']) &&
                (!isset($_POST['category']) || $_POST['category'] == 'x') &&
                (!isset($_POST['brand']) || $_POST['brand'] == 'x')
            ) {
                $is_searched = false;

            } else { // user searched for something
                
                if (!empty($_POST['search'])) {
                    $query .= " and iDesc like '%{$_POST['search']}%'";
                    $msg .= " With `{$_POST['search']}` <br>";
                }
                
                if ($_POST['category'] != 'x') {
                    $query .= " and iCategoryCode = '{$_POST['category']}'";
                    $msg .= " In Category `{$categories[$_POST['category']-1]}` <br>";
                }

                if ($_POST['brand'] != 'x') {
                    $query .= " and iBrand like '%{$brands[$_POST['brand']]}%'";
                    $msg .= " In Brand `{$brands[$_POST['brand']]}`";
                }
                $is_searched = true;
            }

            $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<div class='card'>";
                        echo "<img src='images/{$data['iCode']}.jpg' alt='{$data['iCode']}'>";
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
            } else { // nothing found
                echo "<div class='nothing'>";
                    if ($is_searched == false) {
                        echo "<h2> Database Is Empty </h2>";
                    } else {
                        echo "<h2> $msg </h2>";
                    }
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