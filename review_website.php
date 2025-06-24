<?php
session_start();
include 'db_connectivity.php'; // your DB connection here

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "Please log in to submit a review.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = intval($_POST['rating']);
    $review = trim($_POST['review']);
    $user_id = $_SESSION['user_id'];

if ($rating >= 1 && $rating <= 5 && !empty($review)) {
    $stmt = $conn->prepare("INSERT INTO `website_reviews` (user_id, ratings, reviews) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $rating, $review);
    $stmt->execute();
    $stmt->close();

    echo "<script>
        alert('Your review has been successfully submitted!');
        window.location.href = 'hospital_search.php'
    </script>";
    exit;
}
}

// Fetch all reviews to display
$query = "SELECT wr.reviews, wr.ratings, u.name AS user_name
FROM website_reviews wr
JOIN users u ON wr.user_id = u.user_id
ORDER BY wr.ratings DESC";

$result_reviews = $conn->query($query);

// Fixed anonymous image path (relative to this file)
$anonymous_img = "review_images/anonymous.png";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Website Reviews</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .star { color: gold; font-size: 20px; }
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


    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Submit Your Review</h1>
        <form action="" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Rating</label>
                <div class="star-rating">
                    <input type="radio" id="star5" name="rating" value="5" required><label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4"><label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3"><label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2"><label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1"><label for="star1">★</label>
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
