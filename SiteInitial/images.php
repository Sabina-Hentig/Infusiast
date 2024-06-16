<?php
$images = [
    'images/image1.jpg',
    'images/image2.jpg',
    'images/image3.jpg'
];

foreach ($images as $image) {
    echo "<img src='$image' alt='Slider Image'>";
}
?>