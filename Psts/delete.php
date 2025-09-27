<?php
include 'db.php';
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = intval($_GET['id']);
if (mysqli_query($conn, "DELETE FROM students WHERE id=$id")) {
    header('Location: index.php?msg=deleted');
    exit;
} else {
    die('DB Error: ' . mysqli_error($conn));
}
?>
