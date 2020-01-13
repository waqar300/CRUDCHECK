<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'test') or die(mysqli_error($mysqli));
$id = 0;
 $update = false;
 $name = "";
 $email = "";
if (isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];

    $mysqli->query("INSERT INTO crud(name, email) VALUEs('$name', '$email')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg-type'] = "success";
    header('location: crud.php');
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM crud WHERE id=$id") or die($mysqli->error); 

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg-type'] = "danger";
    header('location: crud.php');
}
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM crud WHERE id=$id") or die($mysqli->error());
    if (count($result)==1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
    }
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mysqli->query("UPDATE crud SET name='$name', email='$email' WHERE id=$id") or die($mysqli->error);
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg-type'] = "warning";
    header('location: crud.php');
}



?>