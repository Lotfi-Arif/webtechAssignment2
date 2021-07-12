<?php

session_start();

$conn = new mysqli("68.183.238.47", "root", "Web.Tech123", "dev_profile")
    or die(mysqli_error($conn));


$errors = array();

if (isset($_POST['add'])) {

    if (empty($_POST['description'])) {
        array_push($errors, "Please provide a description");
    } else {
        $description = $_POST['description'];
    }
    if (empty($_POST['dateAdded'])) {
        array_push($errors, "Please provide a date");
    } else {
        $dateAdded = $_POST['dateAdded'];
    }

    if (empty($errors)) {

        $conn->query("INSERT INTO tasks (description,dateAdded) VALUES ('$description','$dateAdded')")
            or die(mysqli_error($conn));

        $_SESSION['message'] = "Record has been saved";
        $_SESSION['msg_type'] = "success";
        header("location: events.php");
    } else {
        $errors = "";
        for ($i = 0; $i < count($allErrors); $i++) {
            $errors .= $allErrors[$i] .= " ";
        }

        echo "<script type='text/javascript'>
                alert('$errors');
                   window.location='eventsapp.php';
                     </script>";
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $conn->query("DELETE FROM tasks WHERE id = $id")
        or die(mysqli_error($conn));

    $_SESSION['message'] = "Record has been deleted";
    $_SESSION['msg_type'] = "danger";

    header("location: events.php");
}
