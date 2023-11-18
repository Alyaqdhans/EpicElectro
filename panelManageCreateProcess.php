<?php
include('library.php');
include('connect.php');

if (!isset($_POST['code'])) {
    header('Location: error.php?ec=-1'); // entered page without button
    exit;
}

$errors = [];

$name = mysqli_real_escape_string($conn, $_POST['title']);
$desc = mysqli_real_escape_string($conn, $_POST['desc']);
$brand = mysqli_real_escape_string($conn, $_POST['brand']);

if ($_POST['category'] == "x") {
    $errors[] = "Please select a category for your item.";
}

// image upload checks
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$imageId = explode(".", $_FILES["image"]["name"])[0];
// Check if image name is correct
if ($imageId != $_POST['code']) {
    $errors[] = "Please use the given id to name the image.";
}
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
    $errors[] = "File is not an image.";
}
// Check file size
if ($_FILES["image"]["size"] > 5000000) {
    $errors[] = "Sorry, your file is too large.";
}
// Allow jpg file formats
if ($imageFileType != "jpg") {
    $errors[] = "Sorry, only JPG files are allowed.";
}


if (count($errors) == 0) {
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $query = "update items set";
    $query .= " iDesc = '$name',";
    $query .= " iComment = '$desc',";
    $query .= " iBrand = '$brand',";
    $query .= " iCategoryCode = '{$_POST['category']}'";
    $query .= " where iCode = {$_POST['code']}";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));
} else {
    DisplayErrors();
}

header("Location: panelManage.php");
?>