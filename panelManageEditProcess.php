<?php
include('library.php');
include('connect.php');

if (!isset($_POST['code'])) {
    header('Location: error.php'); // trying to access process from address bar
    exit;
}

$errors = [];

$name = mysqli_real_escape_string($conn, $_POST['title']);
$desc = mysqli_real_escape_string($conn, $_POST['desc']);
$brand = mysqli_real_escape_string($conn, $_POST['brand']);

if ($_FILES["image"]["size"] > 0) { // check if image uploaded
    // image upload checks
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $errors[] = "Uploaded file is not an image.";
    }
    // Check file size
    if ($_FILES["image"]["size"] > 4000000) {
        $errors[] = "Sorry, your file is too large.";
    }
}


if (count($errors) > 0) {
    DisplayErrors();
    exit;
}



$query = "update items set";

if ($_FILES["image"]["size"] > 0) { // replace image if uploaded
    $currentExtension = mysqli_fetch_row(mysqli_query($conn, "select img_ext from items where iCode = {$_POST['code']}")); // get old extension
    unlink("images/".$_POST['code'].".".$currentExtension[0]); // delete old image

    $query .= " img_ext = '{$imageExtension}',"; // save new extension
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$_POST['code'].".".$imageExtension); // save & name it to the id
}

$query .= " iDesc = '$name',";
$query .= " iComment = '$desc',";
$query .= " iBrand = '$brand',";
$query .= " iCategoryCode = '{$_POST['category']}'";
$query .= " where iCode = {$_POST['code']}";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

header("Location: panelManage.php?s");
?>