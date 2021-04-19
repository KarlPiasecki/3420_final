<?php

if (isset($_POST['upload'])) {
    $file = $_FILES['image'];

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name']; 
    $fileSize = $_FILES['image']['size']; 
    $fileError = $_FILES['image']['error']; 
    $fileType = $_FILES['image']['type'];

    $price = $_POST['price'];
    $city = $_POST['city'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];

    $fileExt = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExt));

    $allow = array('jpg', 'jpeg', 'png');

    if (in_array($fileExtension, $allow)) {
        if ($fileError === 0) {
            if ($fileSize < 8000000) {
                $newImageName = uniqid('', true).".".$fileExtension;
                $fileDestination = 'uploads/'.$newImageName;
                
                include_once "includes/db_connection.inc.php";

                $sql = "SELECT * FROM listings;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL failure";
                } else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    $sql = "INSERT INTO listings (price, city, keywords, description, imageName) VALUES (?, ?, ?, ?, ?);";
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL failure";
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssss",  $price, $city, $keywords, $description, $newImageName);
                        mysqli_stmt_execute($stmt);

                        move_uploaded_file($fileTmpName, $fileDestination);
                        header("location: listings.php?imageuploadedsuccessfully");
                    }
                }
            } else {
                echo "Image is too large. Maximum image size is 8,000,000kb";
            }
        } else {
            echo "Error uploading image";
        }
    } else {
        echo "Wrong image format";
    }
}



?>