<html>
    <head>
        <?php include('link.php'); ?>
        <title>EpicElectro | Home</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');
        ?>
        
        <form class="top" method="post">
            <div class="search">
                <div class="field">
                   <?php
                    // search field
                    if (isset($_POST['search'])) {$s = $_POST['search'];}
                    else {$s = '';}

                    echo "<input id='search' type=text name='search' placeholder='Search for Something' value='$s'>";
                    ?>
                    <input type="submit" value="Search"> 
                </div>
                
                <?php
                // category filter
                echo "<select name='category'>";
                    echo "<option value='x'> Categories </option>";

                    $query = "select * from categories";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    
                    if (isset($_POST['category'])) {
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

                // brand filter
                echo "<select name='brand'>";
                    echo "<option value='x'> Brands </option>";

                    $query = "select iBrand from items group by iBrand";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                    if (isset($_POST['brand'])) {
                        $brand = $_POST['brand'];
                    } else {
                        $brand = '';
                    }

                    $brands = [];
                    $i = 0;
                    while ($data = mysqli_fetch_assoc($result)) {
                        if ($data['iBrand'] == "") {continue;}

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
            $msg = "Database is empty";

            if (isset($_POST['search']) || isset($_POST['category']) || isset($_POST['brand'])) {
                $msg = "Found nothing <br>";
            }

            if (isset($_POST['search']) && $_POST['search'] != "") {
                $query .= " and iDesc like '%{$_POST['search']}%'";
                $msg .= " with `{$_POST['search']}` <br>";
            }
            
            if (isset($_POST['category']) && $_POST['category'] != 'x') {
                $query .= " and iCategoryCode = '{$_POST['category']}'";
                $msg .= " in category `{$categories[$_POST['category']-1]}` <br>";
            }

            if (isset($_POST['brand']) && $_POST['brand'] != 'x') {
                $query .= " and iBrand like '%{$brands[$_POST['brand']]}%'";
                $msg .= " in brand `{$brands[$_POST['brand']]}`";
            }

            $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    if ($data['iDesc'] == "new") {continue;} // check if its real item

                    echo "<a class='card' href='view.php?ic={$data['iCode']}'>";
                        echo "<div class='img'><img src='images/{$data['iCode']}.jpg' alt='{$data['iCode']}'> <span> ". number_format($data['iPrice']) ." OMR</span></div>";
                        echo "<h3> {$data['iDesc']} </h3>";
                        echo "<h4> by {$data['iBrand']} </h4>";
                        if ($data['iQty'] > 0) {
                            echo "<h5> Available: ✅ </h5>";
                        } else {
                            echo "<h5> Available: ❌ </h5>";
                        }
                        
                        echo "<span class='anchor' id='{$data['iCode']}'></span>"; // scrolls user back
                    echo "</a>";
                }
            } else { // nothing found
                echo "<div class='nothing'>";
                    echo "<h2> $msg </h2>";
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