<?php
include 'includes/db_connection.inc.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="css.css">

</head>
    <a href="index.php"><img class="logo" src="clogo.png" width="100" height="100"></a> <!--Put a link to the homepage in the logo-->

    <nav>
        <!--Get an external stylesheet to add icons to the menu items in the navigation bar-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <a>
        <form action="search.php" method="POST">
        <input class="search" type="search" name="search-field" placeholder="Search for a listing">
        <input type="submit" name="search" value="Search">
        </form>
        </a>
        <?php
        if (isset($_SESSION["userID"])) {
            echo "<a href='includes/logout.inc.php'>Logout</a>";
            echo "<a href='mylistings.php'>Post a Listing</a>";
        }
        else {
            echo "<a href='login.php'>Login/Register</a>";
        }
        ?>
        <a href="listings.php">View Listings</a>
        <a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a>
    </nav> 