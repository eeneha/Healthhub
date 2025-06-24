<!doctype html>
<html class="no-js" lang="en">

<head>
	<!-- meta data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->

	<!--font-family-->
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- title of site -->
	<title>Hospital Search Platform</title>

	<!-- For favicon png -->
	<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png" />

	<!--font-awesome.min.css-->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!--linear icon css-->
	<link rel="stylesheet" href="assets/css/linearicons.css">

	<!--animate.css-->
	<link rel="stylesheet" href="assets/css/animate.css">

	<!--flaticon.css-->
	<link rel="stylesheet" href="assets/css/flaticon.css">

	<!--slick.css-->
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/slick-theme.css">

	<!--bootstrap.min.css-->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- bootsnav -->
	<link rel="stylesheet" href="assets/css/bootsnav.css">

	<!--style.css-->
	<link rel="stylesheet" href="assets/css/style.css">

	<!--responsive.css-->
	<link rel="stylesheet" href="assets/css/responsive.css">


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>

<?php 
require 'fetch_user.php';

echo '<div class="welcome-box">
  <p><strong> Hello, ' . $name . '!</strong></p>
  <p>' . $email . '</p>
  <p>'. $username . '</p>
  <form method="post" action="logout.php">
    <button class="logout-btn">Logout</button>
  </form>
</div>';
?>



<!--welcome-hero start -->
	<section id="home" class="welcome-hero">
		<div class="container">
			<div class="welcome-hero-txt">
				<h2>best place to find and explore <br> best hospitals in Odisha.</h2>
				<p>
					Your Ultimate Hospital Search Companion
				</p>

			</div>
			<div class="welcome-hero-serch-box">
			<div class="welcome-hero-serch-box">
  				<div class="welcome-hero-form">
    			<form action="" method="POST" style="display: flex; align-items: center; justify-content: space-between;">
      				<!-- Hospital Input -->
      				<div class="single-welcome-hero-form" style="flex: 1; margin-right: 10px;">
        			<h3>Hospitals</h3>
        			<input type="text" name="search" placeholder="Ex: Sum Hospital, Apollo Hospital,.." />
        			<div class="welcome-hero-form-icon">
          			<i class="flaticon-list-with-dots"></i>
       				 </div>
      				</div>
					<div class="single-welcome-hero-form">
						<h3>Precision Filter</h3>

						<input type="text" name="filter" placeholder="Ex: Ratings,Specialisation,Location,.." />

						<div class="welcome-hero-form-icon">
							<i class="flaticon-list-with-dots"></i>
						</div>
					</div>
				</div>
				<div class="welcome-hero-serch">
					<button class="welcome-hero-btn" type="submit">
						search <i data-feather="search"></i>
					</button>
				</div>
				</form>
			</div>
		</div>


	</section><!--/.welcome-hero-->
	<!--welcome-hero end -->
	<section id="explore" class="explore">
		<div class="container">
			<div class="section-header">
				<h2>explore</h2>
				<p> Helping You Make the Right Healthcare Choice, Every Time!</p>
			</div><!--/.section-header-->
			<div class="explore-content">
				<div class="row">

				<div class="container">
    

	<?php
	require('db_connectivity.php');
	if (isset($_POST['search'], $_POST['filter'])) {
		$search = $_POST['search'];
		$filter = $_POST['filter'];

			$query = "SELECT * FROM `hospitals` 
			WHERE `name` LIKE '%$search%'
			AND (`city` LIKE '%$filter%'
			OR `rating` LIKE '$filter%'
			OR `specialization` LIKE '%$filter%')";
		

		$result = mysqli_query($conn, $query);

		// Function to highlight search terms
		function highlightWords($text, $word)
		{
			$text = preg_replace('#' . preg_quote($word) . '#i', '<mark class="text-black bg-warning">\\0</mark>', $text);
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
                <img src="' . $row["image_url"] . '" alt="Hospital Image">
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
                    <span class="explore-rating">' . $row["rating"] . '</span>
                    <a href="#">★★★☆☆</a> 
                    <span class="explore-price-box">
                        Phone:
                        <span class="explore-price">' . $row["phone"] . '</span>
                    </span>
                    <a href="#">' . $row["open_hours"] . '</a>
                </p>
                <div class="explore-person">
                    <div class="row">
                        <div class="col-sm-10">
                            <p>' . $row["description"] . '</p>
                        </div>
                    </div>
                </div>
                <div class="explore-open-close-part">
                    <div class="row">
                        <div class="col-sm-5">';
                          echo '<form method="GET" action="hospital_description.php" style="display:inline;">
        <input type="hidden" name="hospital_id" value="' . $row['hospital_id'] . '">
        <button class="close-btn" type="submit">Read More</button>
      </form>

	  </div>
                        <div class="col-sm-7">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';


			$num++; 
		}
	} else {
		$query = "SELECT * FROM `hospitals`";
		$result = mysqli_query($conn, $query);
		$num = 1;
		while ($row = mysqli_fetch_assoc($result)) {
			echo '
       <div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="' . $row["image_url"] . '" alt="explore image">
								<div class="single-explore-img-info">
									<button>best rated</button>
									<div class="single-explore-image-icon-box">
										<ul>
											<li>
												<div class="single-explore-image-icon">
													<i class="fa fa-arrows-alt"></i>
												</div>
											</li>
											<li>
												<div class="single-explore-image-icon">
													<i class="fa fa-bookmark-o"></i>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="single-explore-txt bg-theme-1">
								<h2><a href="#">'.$row["name"].'</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">' . $row["rating"] . '</span>
									<a href="#">★★★☆☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">' . $row["phone"] . '</span>
									</span>
									<a href="#">' . $row["open_hours"] . '</a>
								</p>
								<div class="explore-person">
									<div class="row">
										<div class="col-sm-10">
											<p>
												' . $row["description"] . '
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">'; 
										echo '<form method="GET" action="hospital_description.php" style="display:inline;">
        <input type="hidden" name="hospital_id" value="' . $row['hospital_id'] . '">
        <button class="close-btn" type="submit">Read More</button>
      </form>

										</div>
										<div class="col-sm-7">
										
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
        ';
			$num++;
		}
	}
	?>
				</div>
			</div>
		</div>

		
	<!--reviews start -->
<section id="reviews" class="reviews">
	<div class="section-header">
		<h2>clients reviews</h2>
		<p>What our client say about us</p>
	</div><!--/.section-header-->

	<div class="reviews-content">
		<div class="testimonial-carousel">
			<?php
require('db_connectivity.php');

$query = "SELECT wr.reviews, wr.ratings, u.name AS `name`
          FROM website_reviews wr
          JOIN users u ON wr.user_id = u.user_id";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $stars = '';
    for ($i = 0; $i < 5; $i++) {
      $stars .= $i < $row['ratings'] ? '<i class="fa fa-star"></i>' : '<i class="fa fa-star-o"></i>';
    }

    echo '
    <div class="single-testimonial-box">
      <div class="testimonial-description">
        <div class="testimonial-info">
          <div class="testimonial-img">
           <img src="img/anonymous.png" alt="client" width="50" height="50">
          </div>
          <div class="testimonial-person">
            <h2>' . htmlspecialchars($row["name"]) . '</h2>
            <div class="testimonial-person-star">' . $stars . '</div>
          </div>
        </div>
        <div class="testimonial-comment">
          <p>' . htmlspecialchars($row["reviews"]) . '</p>
        </div>
      </div>
    </div> 
';  
  }
} else {
  echo '<p style="text-align:center;">No reviews available yet.</p>';
}
?>

</div> <!-- close .testimonial-carousel -->
</div> <!-- close .reviews-content -->

<div style="
  text-align: center;
  margin-top: 30px;
">
  <a href="review_website.php" style="
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
  " onmouseover="this.style.backgroundColor='#0056b3'; this.style.transform='translateY(-2px)';"
     onmouseout="this.style.backgroundColor='#007bff'; this.style.transform='translateY(0)';">
    Submit Your Review
  </a>
</div>



		</div>
	</div>
</section>
<!--/.reviews-->

	<!-- Include all js compiled plugins (below), or include individual files as needed -->

	<script src="assets/js/jquery.js"></script>

	<!--modernizr.min.js-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

	<!--bootstrap.min.js-->
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- bootsnav js -->
	<script src="assets/js/bootsnav.js"></script>

	<!--feather.min.js-->
	<script src="assets/js/feather.min.js"></script>

	<!-- counter js -->
	<script src="assets/js/jquery.counterup.min.js"></script>
	<script src="assets/js/waypoints.min.js"></script>

	<!--slick.min.js-->
	<script src="assets/js/slick.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

	<!--Custom JS-->
	<script src="assets/js/custom.js"></script>

</body>
</html>
<style>
.welcome-box {
  position: absolute;
  top: 20px;
  left: 20px;
  background-color: #fff;
  padding: 15px 25px;
  border-radius: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
  z-index: 1000;
}
</style> 
