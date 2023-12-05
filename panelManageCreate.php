<?php session_start(); ?>
<html>
    <head>
        <?php include('link.php') ?>
        <title>EpicElectro | Products</title>
    </head>
    <body>
        <?php
        include('header.php');
        include('connect.php');

        if (!isset($_SESSION['TYPE'])) {
            header('Location: error.php?ec=1'); // login required
            exit;
        } else {
            if ($_SESSION['TYPE'] != 'A') {
                header('Location: error.php?ec=3'); // need admin
                exit;
            }
        }
        ?>
        
        <div class="wrapper">
            <form class="container create" action="panelManageCreateProcess.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Create Product</legend>

                    <?php
                    // check if there is available empty item
                    $query = "select * from items where iDesc = 'new'";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

                    if (mysqli_num_rows($result) == 0) {
                        // if no new empty item create one
                        $query = "insert into items (iDesc, iCategoryCode, iSupplierId, iComment, iQty, iSold, iCost, iPrice, iLastPurchasedDate, iBrand, Active)
                        values ('new', 1, 1, '', 0, 0, 0, 0, 0000-00-00, '', 'disabled')";
                        mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    }

                    // we get the id of the empty item
                    $query = "select * from items where iDesc = 'new'";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    $code = mysqli_fetch_assoc($result)['iCode'];
                    
                    echo "<input type='hidden' name='code' value='$code'>";
                    ?>

                    <label>
                        Product Name: (Ex: iPhone 15+)<br>
                        <input type="text" name="title" required>
                    </label>

                    <label>
                        Product Description: (Ex: model and features)<br>
                        <textarea name="desc" cols="50" rows="8"></textarea>
                    </label>

                    <label>
                        Product Brand: (Ex: Apple)<br>
                        <input type="text" name="brand" required>
                    </label>

                    <label>
                        Product Category:<br>
                        <?php
                        echo "<select name='category' required>";
                        echo "<option value=''> Categories </option>";

                        $query = "select * from categories";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        while ($data = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$data['categoryCode']}'> {$data['categoryDes']} </option>";
                        }
                        echo "</select>";
                        ?>
                    </label>

                    <label>
                        Product Image: (Must be ".jpg" Format)<br>
                        <input class="upload" type="file" name="image" accept=".jpg" required>
                    </label>

                </fieldset>

                <div class="buttons">
                    <input class="btn left" type="submit" value="Save">
                    <a class="btn right" href='panelManage.php'> Cancel </a>
                </div>
            </form>
        </div>

        <?php include('footer.php'); ?>
    </body>
</html>