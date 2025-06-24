<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hospital Description</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="/img/download.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <div class="container-xxl bg-white p-0">
        <div style="max-height: 100px; overflow: hidden; padding: 10px;">
            <img src="img(1)/download(1).png" alt="logo" style="height: 50px;">
        </div>
    </div>

<?php 
require('db_connectivity.php'); 

if (isset($_GET['hospital_id'])) {
    $hospital_id = (int)$_GET['hospital_id'];
    $query = "SELECT h.hospital_id, h.name, d.long_description, d.service_description, d.image1_url, 
              d.image2_url, d.services, d.map_link
              FROM hospitals h
              LEFT JOIN hospital_details d ON h.hospital_id = d.hospital_id
              WHERE h.hospital_id = $hospital_id";

    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = strtoupper($row['name']);
            $words = explode(' ', $name);
            $first = $words[0];
            $rest = implode(' ', array_slice($words, 1));

            echo '<div class="container-fluid header bg-white p-0">';
            echo '<div class="row g-0 align-items-center flex-column-reverse flex-md-row">';
            echo '<div class="col-md-6 p-5 mt-lg-5">';
            echo '<h1 class="display-5 animated fadeIn mb-4"><span class="text-primary">' . $first . ' </span>' . $rest . '</h1>';
            echo '<p class="animated fadeIn mb-4 pb-2">' . $row["long_description"] . '</p>';
            echo '</div>';
            echo '<div class="col-md-6 animated fadeIn">';
            echo '<div class="owl-carousel header-carousel">';
            echo '<div class="owl-carousel-item">';
            echo '<img class="img-fluid" src="' . $row["image1_url"] . '" alt="">';
            echo '</div>';
            echo '<div class="owl-carousel-item">';
            echo '<img class="img-fluid" src="' . $row["image2_url"] . '" alt="">';
            echo '</div>';
            echo '</div></div></div></div>';

            echo '<div class="container-xxl py-5">';
            echo '<div class="container">';
            echo '<div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">';
            echo '<h1 class="mb-3 font-bold">🔬 Expertise & Specialties</h1>';
            echo '<p>' . htmlspecialchars($row["service_description"]) . '</p>';
            echo '</div>';
            echo '<div class="container text-center mt-4">';

            $services = array_filter(array_map('trim', explode("\n", $row["services"])));

            if (!empty($services)) {
                echo '<p class="text-muted" style="max-width: 800px; margin: 0 auto; line-height: 1.8;">';
                echo htmlspecialchars(implode(', ', $services)) . '.';
                echo '</p>';
            } else {
                echo '<p class="text-muted">No services available.</p>';
            }
        }
    }
}
?>
</div>
</div>
</div>

<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
<!-- review -->
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
		<script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
		<script type="text/javascript">
			window.tailwind.config = {
				darkMode: ['class'],
				theme: {
					extend: {
						colors: {
							border: 'hsl(var(--border))',
							input: 'hsl(var(--input))',
							ring: 'hsl(var(--ring))',
							background: 'hsl(var(--background))',
							foreground: 'hsl(var(--foreground))',
							primary: {
								DEFAULT: 'hsl(var(--primary))',
								foreground: 'hsl(var(--primary-foreground))'
							},
							secondary: {
								DEFAULT: 'hsl(var(--secondary))',
								foreground: 'hsl(var(--secondary-foreground))'
							},
							destructive: {
								DEFAULT: 'hsl(var(--destructive))',
								foreground: 'hsl(var(--destructive-foreground))'
							},
							muted: {
								DEFAULT: 'hsl(var(--muted))',
								foreground: 'hsl(var(--muted-foreground))'
							},
							accent: {
								DEFAULT: 'hsl(var(--accent))',
								foreground: 'hsl(var(--accent-foreground))'
							},
							popover: {
								DEFAULT: 'hsl(var(--popover))',
								foreground: 'hsl(var(--popover-foreground))'
							},
							card: {
								DEFAULT: 'hsl(var(--card))',
								foreground: 'hsl(var(--card-foreground))'
							},
						},
					}
				}
			}
		</script>
		<style type="text/tailwindcss">
			@layer base {
				:root {
					--background: 0 0% 100%;
--foreground: 240 10% 3.9%;
--card: 0 0% 100%;
--card-foreground: 240 10% 3.9%;
--popover: 0 0% 100%;
--popover-foreground: 240 10% 3.9%;
--primary: 240 5.9% 10%;
--primary-foreground: 0 0% 98%;
--secondary: 240 4.8% 95.9%;
--secondary-foreground: 240 5.9% 10%;
--muted: 240 4.8% 95.9%;
--muted-foreground: 240 3.8% 46.1%;
--accent: 240 4.8% 95.9%;
--accent-foreground: 240 5.9% 10%;
--destructive: 0 84.2% 60.2%;
--destructive-foreground: 0 0% 98%;
--border: 240 5.9% 90%;
--input: 240 5.9% 90%;
--ring: 240 5.9% 10%;
--radius: 0.5rem;
				}
				.dark {
					--background: 240 10% 3.9%;
--foreground: 0 0% 98%;
--card: 240 10% 3.9%;
--card-foreground: 0 0% 98%;
--popover: 240 10% 3.9%;
--popover-foreground: 0 0% 98%;
--primary: 0 0% 98%;
--primary-foreground: 240 5.9% 10%;
--secondary: 240 3.7% 15.9%;
--secondary-foreground: 0 0% 98%;
--muted: 240 3.7% 15.9%;
--muted-foreground: 240 5% 64.9%;
--accent: 240 3.7% 15.9%;
--accent-foreground: 0 0% 98%;
--destructive: 0 62.8% 30.6%;
--destructive-foreground: 0 0% 98%;
--border: 240 3.7% 15.9%;
--input: 240 3.7% 15.9%;
--ring: 240 4.9% 83.9%;
				}
			}
		</style>
  </head>
      <?php
require('db_connectivity.php');

 if (isset($_GET['hospital_id'])) {
    $hospital_id = (int)$_GET['hospital_id'];

// Get hospital rating from database
$sql = "SELECT `rating` FROM `hospitals` WHERE `hospital_id` = $hospital_id";
$hospital_result = mysqli_query($conn, $sql);

if ($hospital_result && mysqli_num_rows($hospital_result) > 0) {
    $row = mysqli_fetch_assoc($hospital_result);
    $hospital_rating = floatval($row['rating']); // Just in case it's decimal

    echo '
    <div class="bg-card text-card-foreground p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Reviews</h2>
        <div class="flex items-center mb-2">
            <span class="text-primary font-semibold">92%</span> <span class="mx-2">Cleanliness</span>
            <span class="text-primary font-semibold">7.5/10</span> <span class="mx-2">Staff Behavioural</span>
        </div>

        <h3 class="text-lg font-semibold mt-4">Patient rating summary</h3>
        <div class="flex flex-col mb-4">
            <!-- You can dynamically generate these if you want based on review stats -->
            <div class="flex items-center"><span class="font-semibold">5</span>
                <div class="relative w-full h-2 mx-2 bg-zinc-300 rounded">
                    <div class="absolute top-0 left-0 h-2 bg-yellow-500" style="width: 80%;"></div>
                </div>
            </div>
            <div class="flex items-center"><span class="font-semibold">4</span>
                <div class="relative w-full h-2 mx-2 bg-zinc-300 rounded">
                    <div class="absolute top-0 left-0 h-2 bg-zinc-400" style="width: 60%;"></div>
                </div>
            </div>
            <div class="flex items-center"><span class="font-semibold">3</span>
                <div class="relative w-full h-2 mx-2 bg-zinc-300 rounded">
                    <div class="absolute top-0 left-0 h-2 bg-zinc-400" style="width: 0%;"></div>
                </div>
            </div>
            <div class="flex items-center"><span class="font-semibold">2</span>
                <div class="relative w-full h-2 mx-2 bg-zinc-300 rounded">
                    <div class="absolute top-0 left-0 h-2 bg-zinc-400" style="width: 0%;"></div>
                </div>
            </div>
            <div class="flex items-center"><span class="font-semibold">1</span>
                <div class="relative w-full h-2 mx-2 bg-zinc-300 rounded">
                    <div class="absolute top-0 left-0 h-2 bg-yellow-500" style="width: 20%;"></div>
                </div>
            </div>
        </div>

        <div class="flex items-center mb-4">
            <span class="text-4xl font-bold">'. number_format($hospital_rating, 1) .'</span>
            <span class="ml-2 text-yellow-500">';
                // Show filled and empty stars
                $rounded_rating = round($hospital_rating);
                for ($i = 1; $i <= 5; $i++) {
                    echo $i <= $rounded_rating ? '★' : '☆';
                }
    echo '  </span>
        </div>
    </div>';
} else {
    echo "<p class='text-red-500'>Hospital rating not found.</p>";
}
      $sql_reviews = "
    SELECT hr.user_id, hr.user_ratings, hr.reviews, u.name AS user_name
    FROM hospital_reviews hr
    JOIN users u ON hr.user_id = u.user_id
    WHERE hr.hospital_id = $hospital_id
";
$result_reviews = mysqli_query($conn, $sql_reviews);

if ($result_reviews && mysqli_num_rows($result_reviews) > 0) {
    $review_count = 0;

    echo '<h3 class="text-lg font-semibold mt-4">All Patient Reviews</h3>
    <div class="bg-white p-4 rounded-lg shadow-sm mt-6">';

    while($row = mysqli_fetch_assoc($result_reviews)) {
        $review_count++;

        echo '<div class="border-t border-muted mt-4 pt-4">
                <div class="flex items-start mb-4">
                    <span class="text-yellow-500 text-2xl">';

        // Display stars
        $stars = intval($row['user_ratings']);
        for ($i = 0; $i < 5; $i++) {
            echo $i < $stars ? '★' : '☆';
        }

        echo '</span>
                    <div class="ml-3">
                        <p class="font-semibold">' . htmlspecialchars($row["user_name"]) . '</p>
                        <p>' . htmlspecialchars($row["reviews"]) . '</p>
                    </div>
                </div>
              </div>';
    }

     echo '<div class="bg-white p-4 rounded-lg shadow-sm mt-6 text-center">
            <a href="review_submission.php?hospital_id=' . $hospital_id . '" 
               class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
               Submit Your Review
            </a>
          </div>
        </div>'; 

} else {
    echo '<h3 class="text-lg font-semibold mt-4">No reviews yet.</h3>
      <div class="bg-white p-4 rounded-lg shadow-sm mt-6 text-center text-gray-600">
          <p class="mb-4">Be the first to share your experience.</p>
          <a href="review_submission.php?hospital_id=' . $hospital_id . '" 
             class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
             Submit Your Review
          </a>
      </div>';
}
}
$map_query = "SELECT * FROM `hospital_details` WHERE `hospital_id` = $hospital_id";  // Get all map links
$result = mysqli_query($conn, $map_query); 

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Check if there's a map link available for each hospital
        if (!empty($row["map_link"])) {
            // Output the iframe with the sanitized map link
            echo '
            <div style="width: 100%">
                <iframe width="100%" height="600" frameborder="0" scrolling="no" 
                marginheight="0" marginwidth="0" src="'.$row["map_link"] .'">
                </iframe>
            </div>';
        } else {
            echo '<p>No map link available for this hospital.</p>';
        }
    }
} else {
    echo "<p>Failed to retrieve map data. Please try again later.</p>";
}
?>
</html>

