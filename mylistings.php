<?php include_once 'header.php'; ?>

<body style="background-image: url('login.jpg');">

<h1>My Listings</h1>
<div class="listings">
<form action="upload.php" method="POST" enctype="multipart/form-data">
<h2>Post an item to sell</h2>
<p>Image must be of PNG, JPG, or JPEG format</p>
<input type="file" name="image">
<input type="number" name="price" placeholder="Enter the price">
<input type="city" name="city" placeholder="Enter your city">
<input type="text" name="keywords" placeholder="Enter some keywords">
<textarea name="description" placeholder="Write a description" style="height:200px; width:500px;"></textarea>
<input type="submit" name="upload" value="Upload">
</form>
</div>
</body>
</html> 

