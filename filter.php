<?php
require('db_connectivity.php'); 
if(isset($_POST['search'], $_POST['filter'])){
    $search = $_POST['search'];
	$filter = $_POST['filter'];
    $query = "SELECT * FROM `hospitals` WHERE `name` LIKE '%$search%' AND `city` LIKE '%$filter%';";
    $result = mysqli_query($conn, $query);

    // Function to highlight search terms
    function highlightWords($text, $word){
        $text = preg_replace('#'. preg_quote($word) .'#i', '<mark class="text-black bg-warning">\\0</mark>', $text);
        return $text;
    }

    $num = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $highlightName = !empty($search) ? highlightWords($row['name'], $search) : $row['name'];
        // $highlightAddress = !empty($search) ? highlightWords($row['address'], $search) : $row['address'];
        
        echo  
        '
    <div class="col-md-4 col-sm-6">
        <div class="single-explore-item">
            <div class="single-explore-img">
                <img src="'. $row["image_url"] . '" alt="Hospital Image">
                <div class="single-explore-img-info">
                    <button onclick="window.location.href=\'#\'">best rated</button>
                    <div class="single-explore-image-icon-box">
                        <ul>
                            <li><div class="single-explore-image-icon"><i class="fa fa-arrows-alt"></i></div></li>
                            <li><div class="single-explore-image-icon"><i class="fa fa-bookmark-o"></i></div></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="single-explore-txt bg-theme-1">
                <h2><a href="#">' . $highlightName . '</a></h2>
                <p class="explore-rating-price">
                    <span class="explore-rating">' . $row['rating'] . '</span>
                    <a href="#">★★★☆☆</a> 
                    <span class="explore-price-box">
                        Phone:
                        <span class="explore-price">' . $row['phone'] . '</span>
                    </span>
                    <a href="#">' . $row['open_hours'] . '</a>
                </p>
                <div class="explore-person">
                    <div class="row">
                        <div class="col-sm-10">
                            <p>' . $row['description'] . '</p>
                        </div>
                    </div>
                </div>
                <div class="explore-open-close-part">
                    <div class="row">
                        <div class="col-sm-5">
                            <button class="close-btn" onclick="window.location.href=\'/hospital_pages/' . urlencode($row['name']) . '/index.html\'">Read More</button>
                        </div>
                        <div class="col-sm-7">
                            <div class="explore-map-icon">
                                <a href="#"><i data-feather="map-pin"></i></a>
                                <a href="#"><i data-feather="upload"></i></a>
                                <a href="#"><i data-feather="heart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    

        $num++;
    }
} 
else {
    $query = "SELECT * FROM `hospitals`";
    $result = mysqli_query($conn, $query);
    $num = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo '
       <div class="hospital-card">
                <h2><a href="#">' . $row['name'] . '</a></h2>
            </div>
        ';
        $num++;
    }
}
?>
