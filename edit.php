<?php

include "db_conn.php";

$id = $_GET['id'];


if (isset($_POST['submit'])) {

    $first_name = $_POST['first_name'];

    $last_name = $_POST['last_name'];

    $email = $_POST['email'];

    $gender = $_POST['gender'];


    // Validate user input

    if (empty($first_name) || empty($last_name) || empty($email) || empty($gender)) {

        echo "Please fill in all fields";

        exit;

    }


    // Prepare SQL query

    $sql = "UPDATE `crud` SET `first_name`=?, `last_name`=?, `email`=?, `gender`=? WHERE `id`=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $gender, $id);

    $result = $stmt->execute();


    if ($result) {

        header("Location: index.php?msg=Data updated successfully");

    } else {

        echo "Failed: " . $conn->error;

    }

}


$sql = "SELECT * FROM `crud` WHERE `id` = ? LIMIT 1";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_assoc();


if (!$row) {

    echo "User not found";

    exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>PHP CRUD Operation</title>
</head>
<body>

<nav class="navbar navbar-light justify-content-center fs-3 mb-5 "style="background-color:rgb(24, 153, 196)">
    PHP Complete CRUD Operation
</nav>

<div class="container">
    <div class="text-center mb-4 " >
        <h3>Edit User Information </h3>
        <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `crud` WHERE id = '$id' LIMIT 1 ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        echo "User not found";
        exit;
    }
?>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width: 300px;">
            <div class="row" >
                <div class="col">
                    <label class="form-label">First Name :</label>
                    <input type="text" class="form-control" name="first_name" value="<?php  echo $row['first_name']?>" >
                    
                </div>

                <div class="col">
                    <label class="form-label">Last Name :</label>
                    <input type="text" class="form-control" name="last_name"  style="margin-bottom: 10px;" value="<?php  echo $row['last_name']?>" >
                </div>

                <div >
                <label class="form-label">Email :</label>
                <input type="email" class="form-control" name="email" style="margin-bottom: 10px;" value="<?php  echo $row['email']?>" >
                </div>

                <div class="form-group">
                    <label>Gender :</label>
                    <input type="radio" class="form-check-input" name="gender" id="male" value="male" <?php  echo ($row['gender']=='male')?"checked":"";?> style="margin-left:10px;">
                    <label for="male" class="form-input-label">Male</label>

                    
                    <input type="radio" class="form-check-input" name="gender" id="female" value="female" <?php  echo ($row['gender']=='female')?"checked":"";?> style="margin-left:10px;">
                    
                    <label for="female" class="form-input-label" style="margin-bottom: 10px;">Female</label>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit" style="background-color:rgb(24, 153, 196)">Update</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>