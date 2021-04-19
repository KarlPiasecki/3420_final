<?php
include_once 'header.php';
?>

<h1>Search Results</h1>

<div class="login">
    <?php
    if (isset($_POST['search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search-field']);
        $sql = "SELECT * FROM listings WHERE description LIKE '%$search%' OR price LIKE '%$search%' OR city LIKE '%$search%' OR keywords LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $qresult = mysqli_num_rows($result);

        if ($qresult > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href="listing.php?listingID='.$row['listingID'].'"><div><image src="uploads/'.$row["imageName"].'" width="533" height="300"></image></div></a>

                <p>Price: $'.$row["price"].'</p>
                <p>Keywords: '.$row["keywords"].'</p>
                <p>Description: <br>'.$row["description"].'</p>';
            }
        } else {
            echo "No results";
        }
    }

    ?>
</div>