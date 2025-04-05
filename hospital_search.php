<?php
require('db_connectivity.php');
?>


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

	<!-- top-area Start -->
	<section class="top-area">
		<div class="header-area">
			<!-- Start Navigation -->
			<nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy" data-minus-value-desktop="50" data-minus-value-mobile="55" data-speed="1000">

				<div class="container">

					<!-- Start Header Navigation -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
							<i class="fa fa-bars"></i>
						</button>
						<img src="assets/img/download.png" alt="logo" width="130px">

					</div><!--/.navbar-header-->
					<!-- End Header Navigation -->

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
						<ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
							<li class=" scroll active"><a href="#home">home</a></li>
							<li class="scroll"><a href="#explore">explore</a></li>
							<li class="scroll"><a href="#reviews">review</a></li>
						</ul><!--/.nav -->
					</div><!-- /.navbar-collapse -->
				</div><!--/.container-->
			</nav><!--/nav-->
			<!-- End Navigation -->
		</div><!--/.header-area-->
		<div class="clearfix"></div>

	</section><!-- /.top-area-->
	<!-- top-area End -->

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
				<div class="welcome-hero-form">
					<div class="single-welcome-hero-form">
						<form action="" method="POST">
							<h3>Hospitals</h3>

							<input type="text" name="search" placeholder="Ex: Sum Hospital, Apollo Hospital,.." />

							<div class="welcome-hero-form-icon">
								<i class="flaticon-list-with-dots"></i>
							</div>
					</div>
					<div class="single-welcome-hero-form">
						<h3>location</h3>

						<input type="text" name="filter" placeholder="Ex: Cuttack, Bhubaneshwar,.." />

						<div class="welcome-hero-form-icon">
							<i class="flaticon-gps-fixed-indicator"></i>
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
	<?php
	require('db_connectivity.php');
	if (isset($_POST['search'], $_POST['filter'])) {
		$search = $_POST['search'];
		$filter = $_POST['filter'];
		$query = "SELECT * FROM `hospitals` WHERE `name` LIKE '%$search%' AND `city` LIKE '%$filter%';";
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
	} else {
		$query = "SELECT * FROM `hospitals`";
		$result = mysqli_query($conn, $query);
		$num = 1;
		while ($row = mysqli_fetch_assoc($result)) {
			echo '
       <div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="' . $row["image_url"] . '" alt="explore image">
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
										<div class="col-sm-5">
											<button class="close-btn">Read More</button>
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
					</div>
        ';
			$num++;
		}
	}
	?>
				</div>
			</div>
		</div>



	<!--explore start -->
	<section id="explore" class="explore">
		<div class="container">
			<div class="section-header">
				<h2>explore</h2>
				<p> Helping You Make the Right Healthcare Choice, Every Time!</p>
			</div><!--/.section-header-->
			<div class="explore-content">
				<div class="row">
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/sum_hospital.jpeg" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">best rated</button>
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
								<h2><a href="#">SUM Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">3.6</span>
									<a href="#">★★★☆☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">+91-9861923581</span>
									</span>
									<a href="#">Open 24 hours</a>
								</p>
								<div class="explore-person">
									<div class="row">
										<div class="col-sm-10">
											<p>
												One of Odisha's largest, offers affordable General and Super Speciality care, including Cardiology, Neurology, and more.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='/Sum Hospital/index.html'">Read More</button>
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
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/SCB Medical College.jpeg" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">best rated</button>
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
							<div class="single-explore-txt bg-theme-3">
								<h2><a href="#">SCB Medical College</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.6</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">06712414080</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												Odisha’s oldest and most prestigious medical college, known for high-quality healthcare, research, and medical training.

											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Ashwini Hospital.jpeg" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">most view</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Ashwini Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.6</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">09238008811</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A leading multi-speciality hospital offering modern treatments, critical care, and advanced surgical procedures.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read more</button>
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
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/VIMSAR Hospital.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">featured</button>
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
							<div class="single-explore-txt bg-theme-2">
								<h2><a href="#">VIMSAR</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.1</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">06632430768</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A key medical institution in Western Odisha, providing specialized healthcare, medical education, and research facilities.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn open-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class="col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Hi Tech Medical College.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">best rated</button>
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
							<div class="single-explore-txt bg-theme-5">
								<h2><a href="#"> Hi-Tech Medical College</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">3.7</span>
									<a href="#">★★★☆☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">06743500900</span>
									</span>
									<a href="#">Open: Mon-Sat(8:00AM-5:00PM)</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A private medical college and hospital offering quality education, affordable healthcare, and specialized treatments.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/AIIMS Hospital.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">most view</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">AIIMS Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.2</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">06742476789</span>
									</span>
									<a href="#">Open: Mon-Fri(7:30AM-11:30AM) Sat(7:30AM-10:30AM)</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A premier institute providing world-class medical treatment, education, and research, with advanced healthcare facilities.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Ispat General Hospital.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">featured</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Ispat General Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">3.0</span>
									<a href="#">★★★☆☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">06612439114</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A reputed hospital primarily serving steel plant workers and the public, offering multi-speciality medical care.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/MKCG Medical College.jpeg" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">Best Rated</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">MKCG Medical College </a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.7</span>
									<a href="#">★★★★★</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">06802292746</span>
									</span>
									<a href="#">Open: Mon-Sun(9:00AM-5:00PM)</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A government-run medical college and hospital providing specialized and affordable healthcare services.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Kalinga Hospital.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">most view</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Kalinga Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.0</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">18005724000</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A top private hospital in Odisha, known for advanced medical facilities, expert doctors, and quality healthcare services.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Capital Hospital.jpeg" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">most view</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Capital Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">3.9</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">06742391983</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">
										<div class="col-sm-10">
											<p>
												A major government hospital in Bhubaneswar, offering affordable and quality healthcare across various specialities.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Sishu Bhawan.jpeg" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">featured</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Sishu Bhawan</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">3.4</span>
									<a href="#">★★★☆☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">09999999999</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">
										<div class="col-sm-10">
											<p>
												Odisha's largest pediatric hospital, dedicated to child healthcare, neonatal care, and pediatric super-speciality services.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Sun Hospital.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">most view</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Sun Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.3</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">07205715067</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">
										<div class="col-sm-10">
											<p>
												A well-known multi-speciality hospital in Odisha, providing advanced healthcare services across various disciplines, including cardiology, neurology, orthopedics, and critical care.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Sanjivani Hospital.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">Best Rated</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Sanjivani Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.6</span>
									<a href="#">★★★★★</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">09437966900</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A multi-speciality hospital offering quality healthcare, advanced treatments, and patient-centered medical services.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/JP Hospital.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">most view</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">JP Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.0</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">09779109109</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A growing healthcare facility known for quality treatment, emergency services, and specialized medical care.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Sundargarh District Hospital.png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">most view</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Sundargarh District Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.0</span>
									<a href="#">★★★★☆</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">06622272889</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												The primary government hospital serving the Sundargarh region, offering essential medical and emergency care.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>
					<div class=" col-md-4 col-sm-6">
						<div class="single-explore-item">
							<div class="single-explore-img">
								<img src="assets/images/explore/Aditya Ashwini Hospital .png" alt="explore image">
								<div class="single-explore-img-info">
									<button onclick="window.location.href='#'">Best Rated</button>
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
							<div class="single-explore-txt bg-theme-4">
								<h2><a href="#">Aditya Ashwini Hospital</a></h2>
								<p class="explore-rating-price">
									<span class="explore-rating">4.9</span>
									<a href="#">★★★★★</a>
									<span class="explore-price-box">
										Phone:
										<span class="explore-price">09238008803</span>
									</span>
									<a href="#">Open 24 Hours</a>
								</p>
								<div class="explore-person">
									<div class="row">

										<div class="col-sm-10">
											<p>
												A private hospital providing comprehensive healthcare, including specialized treatments and diagnostic services.
											</p>
										</div>
									</div>
								</div>
								<div class="explore-open-close-part">
									<div class="row">
										<div class="col-sm-5">
											<button class="close-btn" onclick="window.location.href='#'">Read More</button>
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
					</div>


				</div>
			</div>
		</div><!--/.container-->

	</section><!--/.explore-->
	<!--explore end -->

	<!--reviews start -->
	<section id="reviews" class="reviews">
		<div class="section-header">
			<h2>clients reviews</h2>
			<p>What our client say about us</p>
		</div><!--/.section-header-->
		<div class="reviews-content">
			<div class="testimonial-carousel">
				<div class="single-testimonial-box">
					<div class="testimonial-description">
						<div class="testimonial-info">
							<div class="testimonial-img">
								<img src="assets/images/clients/profile-user.png" alt="clients">
							</div><!--/.testimonial-img-->
							<div class="testimonial-person">
								<h2>Dr. Anish Saha</h2>
								<h4>New Delhi, India</h4>
								<div class="testimonial-person-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div><!--/.testimonial-person-->
						</div><!--/.testimonial-info-->
						<div class="testimonial-comment">
							<p>
								HealthHub made finding the right hospital so easy! The search filters and patient reviews helped me choose the best facility for my treatment. Highly recommended!
							</p>
						</div><!--/.testimonial-comment-->
					</div><!--/.testimonial-description-->
				</div><!--/.single-testimonial-box-->
				<div class="single-testimonial-box">
					<div class="testimonial-description">
						<div class="testimonial-info">
							<div class="testimonial-img">
								<img src="assets/images/clients/profile-user.png" alt="clients">
							</div><!--/.testimonial-img-->
							<div class="testimonial-person">
								<h2>Arun P.</h2>
								<h4>Cuttack, India</h4>
								<div class="testimonial-person-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div><!--/.testimonial-person-->
						</div><!--/.testimonial-info-->
						<div class="testimonial-comment">
							<p>
								I was able to compare hospitals in my area and check real-time availability. The platform is user-friendly and saved me a lot of time!
							</p>
						</div><!--/.testimonial-comment-->
					</div><!--/.testimonial-description-->
				</div><!--/.single-testimonial-box-->
				<div class="single-testimonial-box">
					<div class="testimonial-description">
						<div class="testimonial-info">
							<div class="testimonial-img">
								<img src="assets/images/clients/profile-user.png" alt="clients">
							</div><!--/.testimonial-img-->
							<div class="testimonial-person">
								<h2>Priya D.</h2>
								<h4>Bhubaneshwar, India</h4>
								<div class="testimonial-person-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div><!--/.testimonial-person-->
						</div><!--/.testimonial-info-->
						<div class="testimonial-comment">
							<p>
								I found a nearby hospital during an emergency within minutes! HealthHub is a must-have tool for everyone in Odisha.
							</p>
						</div><!--/.testimonial-comment-->
					</div><!--/.testimonial-description-->
				</div><!--/.single-testimonial-box-->
				<div class="single-testimonial-box">
					<div class="testimonial-description">
						<div class="testimonial-info">
							<div class="testimonial-img">
								<img src="assets/images/clients/profile-user.png" alt="clients">
							</div><!--/.testimonial-img-->
							<div class="testimonial-person">
								<h2>Manisha S.</h2>
								<h4>Bhubaneshwar, India</h4>
								<div class="testimonial-person-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div><!--/.testimonial-person-->
						</div><!--/.testimonial-info-->
						<div class="testimonial-comment">
							<p>
								Instead of searching multiple websites, I found everything in one place. HealthHub is the best hospital search platform in Odisha!
							</p>
						</div><!--/.testimonial-comment-->
					</div><!--/.testimonial-description-->
				</div><!--/.single-testimonial-box-->
				<div class="single-testimonial-box">
					<div class="testimonial-description">
						<div class="testimonial-info">
							<div class="testimonial-img">
								<img src="assets/images/clients/profile-user.png" alt="clients">
							</div><!--/.testimonial-img-->
							<div class="testimonial-person">
								<h2>Priyanka D.</h2>
								<h4>Sundargarh, India</h4>
								<div class="testimonial-person-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div><!--/.testimonial-person-->
						</div><!--/.testimonial-info-->
						<div class="testimonial-comment">
							<p>
								My family and I use HealthHub whenever we need medical care. It’s reliable, easy to use, and provides all the information we need!
							</p>
						</div><!--/.testimonial-comment-->
					</div><!--/.testimonial-description-->
				</div><!--/.single-testimonial-box-->
				<div class="single-testimonial-box">
					<div class="testimonial-description">
						<div class="testimonial-info">
							<div class="testimonial-img">
								<img src="assets/images/clients/profile-user.png" alt="clients">
							</div><!--/.testimonial-img-->
							<div class="testimonial-person">
								<h2>Dr. Vivek Mohanty</h2>
								<h4>Kolkata, India</h4>
								<div class="testimonial-person-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div><!--/.testimonial-person-->
						</div><!--/.testimonial-info-->
						<div class="testimonial-comment">
							<p>
								HealthHub is revolutionizing hospital searches in Odisha. The detailed information and user-friendly interface make it the best in the market!
							</p>
						</div><!--/.testimonial-comment-->
					</div><!--/.testimonial-description-->
				</div><!--/.single-testimonial-box-->
				<div class="single-testimonial-box">
					<div class="testimonial-description">
						<div class="testimonial-info">
							<div class="testimonial-img">
								<img src="assets/images/clients/profile-user.png" alt="clients">
							</div><!--/.testimonial-img-->
							<div class="testimonial-person">
								<h2>Satyam R. </h2>
								<h4>Jamshedpur, India</h4>
								<div class="testimonial-person-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div><!--/.testimonial-person-->
						</div><!--/.testimonial-info-->
						<div class="testimonial-comment">
							<p>
								I love how simple and detailed this platform is. I could compare hospitals, check services, and even see real-time availability. Brilliant idea!
							</p>
						</div><!--/.testimonial-comment-->
					</div><!--/.testimonial-description-->
				</div><!--/.single-testimonial-box-->
				<div class="single-testimonial-box">
					<div class="testimonial-description">
						<div class="testimonial-info">
							<div class="testimonial-img">
								<img src="assets/images/clients/profile-user.png" alt="clients">
							</div><!--/.testimonial-img-->
							<div class="testimonial-person">
								<h2>Mukesh N.</h2>
								<h4>UP, India</h4>
								<div class="testimonial-person-star">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
							</div><!--/.testimonial-person-->
						</div><!--/.testimonial-info-->
						<div class="testimonial-comment">
							<p>
								I found a top-rated hospital for my mother’s treatment in seconds. The ratings and patient feedback really helped in decision-making!
							</p>
						</div><!--/.testimonial-comment-->
					</div><!--/.testimonial-description-->
				</div><!--/.single-testimonial-box-->
			</div>
		</div>

	</section><!--/.reviews-->
	<!--reviews end -->


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