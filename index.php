<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./assets/css/home.css"> -->
    <link rel="stylesheet" href="./assets/css/home.css">
</head>
<body>
    <!-- header  -->
<?php include_once("header.php") ?>
<div>
    <div class="owl-carousel py-4">
    <div class="item" ><img class='carouselImage' src="media/crousel/carousel1.jpg" alt="Image 1"></div>
    <div class="item" ><img class='carouselImage' src="media/crousel/carousel2.jpg" alt="Image 2"></div>
    <div class="item" ><img class='carouselImage' src="media/crousel/carousel3.jpg" alt="Image 3"></div>
    <!-- Add more items as needed -->
</div>
<div>
    <h1>Song Released</h1>
    <div class="songCategoryCard">
      <h1 id="main-title" class='songCategoryTitle'>Keroue</h1>
      <div id="track-info" class='songCategoryImage'>
                <img class='w-100' src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fcdns-images.dzcdn.net%2Fimages%2Fartist%2F62adf629ddebc20efdae292e4d4382eb%2F500x500.jpg&f=1&nofb=1&ipt=a94c9ffde92718ba9d18cf2c2bc9b988c2b23d43c381747692f0d844196be388&ipo=images"/>
      </div>
     
    </div>


</div>

</div>
<?php include_once("footer.php") ?>
    
</body>
<script>
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
    center: true,
    nav:true,
    items:3,
    loop:true,
    margin:10,

});
 
});
</script>
</html>