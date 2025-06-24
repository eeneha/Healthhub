<?php
require('db_connectivity.php');
session_start();

// Check if user is logged in
   if (!isset($_SESSION['user_id'])) {
    echo "<script>
        alert('Please log in to submit a review.');
        window.location.href = 'login.php';
    </script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Check if hospital ID is provided
if (!isset($_GET['hospital_id'])) {
    echo 'Hospital ID missing.';
    exit;
}
$hospital_id = (int)$_GET['hospital_id'];

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = (int)$_POST['rating'];
    $review = mysqli_real_escape_string($conn, $_POST['review']);

    $sql_insert = "
        INSERT INTO hospital_reviews (hospital_id, user_id, user_ratings, reviews) 
        VALUES ('$hospital_id', '$user_id', '$rating', '$review')
        ON DUPLICATE KEY UPDATE 
            user_ratings = VALUES(user_ratings), 
            reviews = VALUES(reviews)
    ";

    if (!mysqli_query($conn, $sql_insert)) {
        echo 'Error submitting review: ' . mysqli_error($conn); 
    } else {
        echo "<script>
            alert('Your review has been successfully submitted!');
            window.location.href = 'hospital_description.php?hospital_id=$hospital_id';
        </script>";
        exit;
    }
}

// Fetch reviews
$sql_reviews = "
    SELECT hr.user_ratings, hr.reviews, u.name AS user_name
    FROM hospital_reviews hr
    JOIN users u ON hr.user_id = u.user_id
    WHERE hr.hospital_id = $hospital_id
";
$result_reviews = mysqli_query($conn, $sql_reviews);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }
        .star-rating input[type="radio"] { display: none; }
        .star-rating label {
            font-size: 2rem;
            color: #d1d5db;
            cursor: pointer;
            margin: 0 4px;
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f59e0b;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- 📝 Review Form -->
    <div class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Submit Your Review</h1>
        <form action="" method="POST">
             <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Rating</label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1">★</label>
                </div>
            </div>
            <div class="mb-4">
                <label for="review" class="block text-gray-700 font-medium mb-2">Review</label>
                <textarea id="review" name="review" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="5" placeholder="Write your review here"></textarea>
            </div>
            <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">
                Submit Review
            </button>
        </form>
    </div>

   
</body>
</html>
