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
            <form class="container create" action="panelManageEditProcess.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Edit Product</legend>

                    <?php
                    $query = "select * from items where iCode = '{$_GET['ic']}'";
                    $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                    $data = mysqli_fetch_assoc($result);

                    echo "<input type='hidden' name='code' value='{$_GET['ic']}'>";
                    ?>

                    <label>
                        Product Name:<br>
                        <?php echo "<input type='text' name='title' value='{$data['iDesc']}' required>"; ?>
                    </label>

                    <label>
                        Product Description:<br>
                        <?php echo "<textarea name='desc' cols='50' rows='8'>{$data['iComment']}</textarea>"; ?>
                    </label>

                    <label>
                        Product Brand:<br>
                        <?php echo "<input type='text' name='brand' value='{$data['iBrand']}' required>"; ?>
                    </label>

                    <label>
                        Product Category:<br>
                        <?php
                        echo "<select name='category' required>";
                        echo "<option value=''> Categories </option>";

                        $query = "select * from categories";
                        $result = mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
                        
                        while ($data2 = mysqli_fetch_assoc($result)) {
                            if ($data2['categoryCode'] == $data['iCategoryCode']) {$s = "selected";}
                            else {$s = "";}
                            echo "<option value='{$data2['categoryCode']}' $s> {$data2['categoryDes']} </option>";
                        }
                        echo "</select>";
                        ?>
                    </label>

                    <label>
                        Product Image:<br>
                        <?php echo "<div class='img'><img src='images/{$_GET['ic']}.jpg' alt='Not Found'></div>"; ?>
                    </label>

                    <label>
                        Change Product Image: (Must be ".jpg" Format)<br>
                        <input class="upload" type="file" name="image" accept=".jpg">
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