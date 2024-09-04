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
    <!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Coco Admin - Wishes </title>
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

        .wish {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .wish p {
            margin: 0;
            color: #666;
        }

        .approve-btn, .reject-btn {
            padding: 5px 10px;
            margin-right: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .approve-btn {
            background-color: #4CAF50;
            color: white;
        }

        .reject-btn {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>




	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Sweet Coco</span>
		</a>
		<ul class="side-menu top">
			<li>
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
			<li class="active">
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
				<a href="attendance.php">
	            <i class='bx bx-check'></i>
					<span class="text">Confirmation of Attendance</span>
				</a>
			</li>
			
			<li>
				<a href="innerreg.php">
					<i class='bx bxs-group' ></i>
					<span class="text">Add Admin</span>
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
                <h1>Manage Wishes</h1>
                
                <?php
                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sweetcoco";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve wishes and related data from Attendance table
                $sql = "SELECT wish, card_id, status FROM Attendance WHERE status = 1"; // Adjust this query as per your database schema
                $result = $conn->query($sql);

                // Check if the query was successful
                if ($result === false) {
                    echo "Error executing query: " . $conn->error;
                } else {
                    // Check if any wishes were found
                    if ($result->num_rows > 0) {
                        // Output each wish with approve and reject buttons
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='wish'>";
                            echo "<p>Card ID: " . $row['card_id'] . "</p>";
                            echo "<p>Wish: " . $row['wish'] . "</p>";
                            // Add approve and reject buttons here
                            echo "<button class='approve-btn' onclick='approveWish(" . $row['card_id'] . ", this)'>Approve</button>";
                            echo "<button class='reject-btn' onclick='rejectWish(" . $row['card_id'] . ", this)'>Reject</button>";
                            echo "</div>";
                        }
                    } else {
                        echo "No wishes found.";
                    }
                }

                $conn->close();
                ?>
            </div>

            <!-- Include necessary JavaScript -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function approveWish(cardId, button) {
                    $.ajax({
                        type: 'POST',
                        url: 'update_status.php',
                        data: { card_id: cardId, status: 1 },
                        success: function(response) {
                            button.textContent = 'Approved';
                            button.disabled = true; // Disable the button after approving
                            alert(response);
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }

                function rejectWish(cardId, button) {
                    $.ajax({
                        type: 'POST',
                        url: 'update_status.php',
                        data: { card_id: cardId, status: 0 },
                        success: function(response) {
                            button.textContent = 'Rejected';
                            button.disabled = true; // Disable the button after rejecting
                            alert(response);
                        },
                        error: function(xhr, status, error) {
                            alert('Error: ' + error);
                        }
                    });
                }
            </script>
        </main>
		<!-- MAIN -->
	</section>
	
	

	<script src="script.js"></script>
</body>
</html>
   

