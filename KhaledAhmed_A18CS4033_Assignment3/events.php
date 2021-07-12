<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Scheduler</title>



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="./style.css" />
</head>

<body>

    <?php require_once 'eventService.php'; ?>
    <?php if (isset($_SESSION['message'])) :   ?>

        <div class="alert alert-<?php echo $_SESSION['msg_type'] ?> " role="alert" id="alert">
            <?php

            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>


    <?php
    $con = new mysqli("68.183.238.47", "root", "Web.Tech123", "dev_profile");
    $result = $con->query("SELECT * FROM tasks")
        or die(mysqli_error($con));
    ?>



    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Event Scheduler</a>
            </li>
        </ul>
    </nav>



    <br>

    <div class="jumbotron">
        <h1>Events</h1>

        <br>
        <br>




        <div class=" fa-pull-right">
            <form action="eventService.php" method="post">

                <h4>Insert Event</h4>
                <input type="text" placeholder="Enter Title Name" name="description" id="input-wrapper-title-sized">
                <h4>Insert Date </h4>
                <input type="date" placeholder="Enter Title Name" name="dateAdded" id="input-wrapper-title-sized">

                <input type="submit" value="Add Event" name="add" id="input-wrapper-submit">
            </form>
        </div>



    </div>
    <div class="container">
        <div class="row">

            <?php while ($row = $result->fetch_assoc()) :  ?>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="box-part text-center">
                        <h2>Event <?php echo $row['id'] ?></h2>
                        <h6><?php echo $row['description'] ?></h6>
                        <h6>Date Added : <?php echo $row['dateAdded'] ?></h6>
                        <a href="eventService.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">delete</a>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>
    </div>





</body>

</html>