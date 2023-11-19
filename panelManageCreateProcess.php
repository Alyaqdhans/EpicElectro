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

// image upload checks
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
    $errors[] = "File is not an image.";
}
// Check file size
if ($_FILES["image"]["size"] > 5000000) {
    $errors[] = "Sorry, your file is too large. (Max 5MB)";
}
// Allow jpg file formats
if ($imageFileType != "jpg") {
    $errors[] = "Sorry, only JPG files are allowed.";
}


if (count($errors) == 0) {
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$_POST['code'].".jpg"); // save & name it to the id

    $query = "update items set";
    $query .= " iDesc = '$name',";
    $query .= " iComment = '$desc',";
    $query .= " iBrand = '$brand',";
    $query .= " iCategoryCode = '{$_POST['category']}'";
    $query .= " where iCode = {$_POST['code']}";
    mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

    header("Location: panelManage.php");
} else {
    DisplayErrors();
}
?>