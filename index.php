<?php session_start(); ?>
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
        
        <div class="index">
            <form class="top" method="post" action="index.php">
                <div class="search">
                    <div class="field">
                        <?php
                        // search field
                        if (isset($_POST['search'])) {$s = $_POST['search'];}
                        else {$s = '';}

                        echo "<input id='search' type='search' name='search' placeholder='Search for something' value='$s'>";
                        ?>
                        <input type="submit" value="Search"> 
                    </div>

                    <?php
                    // category filter
                    $query = "select * from categories";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    $categories = [];
                    echo "<select name='category'>";
                    echo "<option value='x'> Categories </option>";
                    while ($data = mysqli_fetch_assoc($result)) {
                        $categories[] = $data['categoryDes'];
                        if (isset($_POST['category']) && $_POST['category'] == $data['categoryCode']) {$select = 'selected';}
                        else {$select = '';}
                        echo "<option value='{$data['categoryCode']}' $select> {$data['categoryDes']} </option>";
                    }
                    echo "</select>";

                    // brand filter
                    $query = "select iBrand from items where iDesc != 'new' and Active != 'disabled' group by iBrand";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    echo "<select name='brand'>";
                    echo "<option value='x'> Brands </option>";
                    while ($data = mysqli_fetch_assoc($result)) {                        
                        if (isset($_POST['brand']) && $_POST['brand'] == $data['iBrand']) {$select = 'selected';}
                        else {$select = '';}
                        echo "<option value='{$data['iBrand']}' $select> {$data['iBrand']} </option>";
                    }
                    echo "</select>";

                    // price filter
                    if (isset($_POST['price'])) {
                        if ($_POST['price'] == "desc") {$desc = "selected"; $asc = "";}
                        if ($_POST['price'] == "asc") {$desc = ""; $asc = "selected";}
                        if ($_POST['price'] == "x") {$desc = ""; $asc = "";}
                    }
                    echo "<select name='price'>";
                        echo "<option value='x'> Price </option>";
                        echo "<option value='desc' $desc> High to Low </option>";
                        echo "<option value='asc' $asc> Low to High </option>";
                    echo "</select>";
                    ?>
                
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
                    
                </div>
            </form>

            <section class="grid">
                <?php
                $query = "select * from items where iCode = iCode and Active != 'disabled'";
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
                    $query .= " and iBrand like '%{$_POST['brand']}%'";
                    $msg .= " in brand `{$_POST['brand']}`";
                }
                
                if (isset($_POST['price']) && $_POST['price'] != 'x') {
                    $query .= " order by iPrice {$_POST['price']}";
                } else if (isset($_POST['search']) && $_POST['search'] != "" ||
                           isset($_POST['category']) && $_POST['category'] != 'x' || 
                           isset($_POST['brand']) && $_POST['brand'] != 'x') {
                    $query .= " order by iDesc asc";
                } else {
                    $query .= " order by iCode desc";
                }
                

                $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo "<a class='card' href='view.php?ic={$data['iCode']}'>";
                            echo "<div class='img'><img src='images/{$data['iCode']}.{$data['img_ext']}' alt='{$data['iCode']}'> <span> ". number_format($data['iPrice']) ." OMR</span></div>";
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
        </div>
        
        <div class="scroll">
            <a class="btn up" href="#up">▲</a>
            <a class="btn down" href="#down">▼</a>
        </div>

        <?php include('footer.php'); ?>
        <?php if (isset($_GET["s"])) {echo "<script>notify('Logged In Successfully');</script>";} // login successful ?>
    </body>
</html>