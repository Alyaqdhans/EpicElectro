<?php
$pages = [
    'EpicElectro' => 'Home',
    'example1' => 'Example1',
    'example2' => 'Example2',
    'example3' => 'Example3',
    'Login' => 'Login',
];

$currentFolder = basename(dirname($file));

echo "<nav>";
if ($currentFolder == "EpicElectro") {
    echo "<img src='../icon.png'>";
}
foreach ($pages as $folderName => $pageTitle) {
    if ($folderName == $currentFolder) {
        echo "<title> $pageTitle </title>";
    } else {
        if ($pageTitle == "Home") {
            echo "<a href='../'> <img src='../icon.png'> </a>";
        } else {
            echo "<a class='ln' href='$folderName/'> $pageTitle </a>";
        }
    }
}
echo "</nav>";
?>