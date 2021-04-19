<?php include_once 'header.php'; ?>

<body style="background-image: url('login.jpg');">

<h1>Listings</h1>

<div class="listings">
    <?php
    include_once 'includes/db_connection.inc.php';
    $sql = "SELECT * FROM listings ORDER BY listingID";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL failure";
    } else {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="listing.php?listingID='.$row['listingID'].'"><div><image src="uploads/'.$row["imageName"].'" width="533" height="300"></image></div></a>

            <p>Price: $'.$row["price"].'</p>
            <p>Location: '.$row["city"].'</p>
            <p>Keywords: '.$row["keywords"].'</p>
            <p>Description: <br>'.$row["description"].'</p>';
        }
    }
    ?>
</div>

</body>
</html> 