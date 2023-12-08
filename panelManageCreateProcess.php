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

// image upload checks
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
    $errors[] = "File is not an image.";
}
// Check file size
if ($_FILES["image"]["size"] > 4000000) {
    $errors[] = "Sorry, your file is too large.";
}


if (count($errors) > 0) {
    DisplayErrors();
    exit;
}


move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$_POST['code'].".".$imageExtension); // save & name it to the id

$query = "update items set";
$query .= " iDesc = '$name',";
$query .= " iComment = '$desc',";
$query .= " iBrand = '$brand',";
$query .= " iCategoryCode = '{$_POST['category']}',";
$query .= " img_ext = '{$imageExtension}',";
$query .= " Active = 'active'";
$query .= " where iCode = {$_POST['code']}";
mysqli_query($conn, $query) or die("Error in query: <mark>$query</mark> <p>". mysqli_error($conn));

header("Location: panelManage.php?s");
?>