<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Cards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .wedding-card {
            display: block;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .wedding-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>

<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title>Admin-Sweet Coco</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Sweet Coco</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="dashboard.php">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="create_card.php">
					<i class='bx bxs-shopping-bag-alt' ></i>
					<span class="text">Create Wedding cards</span>
				</a>
			</li>
			<li>
				<a href="wish_list.php">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Manage Wishes</span>
				</a>
			</li>
			<li>
				<a href="card.php">
				<i class='bx bx-list-ul' ></i>
					<span class="text">Wedding Card List</span>
				</a>
			</li>
			<li>
				<a href="innerreg.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Add Users</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<!-- <li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li> -->
			<li>
				<a href="login.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Minimize  </a>
			<form action="#">
			<div class="form-input">
					<input type="hidden" placeholder="Search...">
					<!-- <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button> -->
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<!-- <label for="switch-mode" class="switch-mode"></label> -->
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">0</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			

        <div class="container">
        <h1>Wedding Cards</h1>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "wedding_card_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve wedding card data from the database
        $sql = "SELECT id, bride_name, groom_name FROM wedding_cards"; // Selecting only necessary fields
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            // while($row = $result->fetch_assoc()) {
            //     $id = $row["id"];
            //     $bride_name = $row["bride_name"];
            //     $groom_name = $row["groom_name"];
                
            //     echo "<a class='wedding-card' href='wedding_card.php?id=$id' target='_blank'>$bride_name & $groom_name's Wedding</a><br>";
            // }
// Output data of each row
while($row = $result->fetch_assoc()) {
    $bride_name = urlencode($row["bride_name"]); // Encoding the bride's name for URL
    $groom_name = urlencode($row["groom_name"]); // Encoding the groom's name for URL
    // Generate link to individual wedding card page with groom's and bride's names
    echo "<a class='wedding-card' href='wedding_card.php?bride=$bride_name&groom=$groom_name' target='_blank'>$bride_name & $groom_name's Wedding</a><br>";
}


			
        } else {
            echo "No wedding cards found.";
        }

        $conn->close();
        ?>
    </div>


		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>
 

