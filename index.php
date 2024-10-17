<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/home.css">
</head>

<body>
    <!-- header  -->
    <?php include_once("header.php") ?>
    <div>
        <div class="owl-carousel py-4">
            <div class="item"><img class='carouselImage' src="media/crousel/carousel1.jpg" alt="Image 1"></div>
            <div class="item"><img class='carouselImage' src="media/crousel/carousel2.jpg" alt="Image 2"></div>
            <div class="item"><img class='carouselImage' src="media/crousel/carousel3.jpg" alt="Image 3"></div>
        </div>
        <div>
            <h2>Song Released</h2>
            <div class="category-carousel py-4">
                <?php
                $jsonFile = 'data.json';

                // Check if the JSON file exists
                if (file_exists($jsonFile)) {
                    // Read the JSON file
                    $jsonData = file_get_contents($jsonFile);

                    // Decode the JSON data to PHP associative array
                    $data = json_decode($jsonData, true);

                    // Check if data is decoded successfully
                    if ($data !== null) {
                        // Loop through each category
                        // <div>
                
                    foreach ($data['categories'] as $category) {
                        $categoryId = $category['id'];
                        $categoryName = $category['name'];
                        $categorycoverImage = $category['coverImage'];

                    echo "<a class='aTag'  style='text-decoration:none;width:200px:' href='category.php?id=$categoryId'>"; 
                    echo "<div class='songCategoryCard'>"; 
                    echo "<h1 id='main-title' class='songCategoryTitle'>$categoryName</h1>"; 
                    echo "<div id='track-info' class='songCategoryImage'>"; 
                    echo "<img class='w-100 h-100' src='$categorycoverImage'/>"; 
                    echo "</div>"; 
                    echo "</div>"; 
                    echo "</a>"; 
                    }                    
                    } else {
                        echo "<p>Failed to decode JSON data.</p>";
                    }
                } else {
                    echo "<p>JSON file not found.</p>";
                }
                ?>
            </div>
        </div>
        <div>
            <h2>Top Artists</h2>
            <div class="d-flex flex-wrap justify-content-around py-4">
                <?php
                $jsonFile = 'data.json';

                // Check if the JSON file exists
                if (file_exists($jsonFile)) {
                    // Read the JSON file
                    $jsonData = file_get_contents($jsonFile);

                    // Decode the JSON data to PHP associative array
                    $data = json_decode($jsonData, true);

                    // Check if data is decoded successfully
                    if ($data !== null) {
                        // Loop through each category
                        // <div>
                
                    foreach ($data['popularArtists'] as $artists) {
                        $artistsName = $artists['name'];
                        $artistsImage = $artists['image'];

                    // echo "<a class='aTag'  style='text-decoration:none;width:200px:' href='category.php?id=$categoryId'>"; 
                    echo "<div class='songCategoryCard'>"; 
                    echo "<h1 id='main-title' class='songCategoryTitle'>$artistsName</h1>"; 
                    echo "<div id='track-info' class='songCategoryImage'>"; 
                    echo "<img class='w-100 h-100' src='$artistsImage'/>"; 
                    echo "</div>"; 
                    echo "</div>"; 
                    // echo "</a>"; 
                    }                    
                    } else {
                        echo "<p>Failed to decode JSON data.</p>";
                    }
                } else {
                    echo "<p>JSON file not found.</p>";
                }
                ?>
            </div>
        </div>

    </div>
    <?php include_once("footer.php") ?>

</body>
<script>
$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        center: true,
        nav: true,
        items: 3,
        loop: true,
        margin: 10,

    });
    // $('.category-carousel').owlCarousel({
    //     center: true,
    //     nav:true,
    //     items:4,
    //     loop:true,
    //     margin:10,

    // });

});
</script>

</html>