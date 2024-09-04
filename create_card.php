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
    <title>Create Wedding Card</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            /* background-image: url('.//images/wed.jpg'); */
            background-repeat: repeat;
        }

        .container {
            /* background-image: url('.//images/wed.jpg'); */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #fff;
            padding-top: 450px;
            margin-bottom: 20px;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            /* padding: 30px; */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
            margin-bottom: 30px;
           
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="datetime-local"],
        input[type="file"],
        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            padding-top: 5px;
        }

        button {
            background-color: #111111;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #413f3f;
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
        <li >
            <a href="dashboard.php">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="active">
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
			<form action="#" >
				<div class="inpu">
					<input type="hidden" placeholder="Search...">
				
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
            <h1 style="Color:black; margin-top: 850px; margin:bottom: 0px; font-weight: 500;text-align: center; text-transform:uppercase; font-size: 1.8rem;" >Enter Groom's & Bride's Details <br> to Create their Wedding Card</h1>
            
            <form action="process_form.php" method="POST" enctype="multipart/form-data" style=" padding: 30px; ">
                <label for="bride_name">Bride's Name:</label>
                <input type="text" id="bride_name" name="bride_name" required>

                <label for="groom_name">Groom's Name:</label>
                <input type="text" id="groom_name" name="groom_name" required>

                <label for="bride_father_name">Bride's Father's & Mother's Name:</label>
                <input type="text" id="bride_father_name" name="bride_father_name" required>

                <!--<label for="bride_mother_name">Bride's Mother's Name:</label>-->
                <!--<input type="text" id="bride_mother_name" name="bride_mother_name" required>-->

                <label for="groom_father_name">Groom's Father's & Mother's Name:</label>
                <input type="text" id="groom_father_name" name="groom_father_name" required>

                <!--<label for="groom_mother_name">Groom's Mother's Name:</label>-->
                <!--<input type="text" id="groom_mother_name" name="groom_mother_name" required>-->

                <label for="poruwa_time">Reception Time:</label>
                <input type="datetime-local" id="poruwa_time" name="poruwa_time" required>

                <label for="going_away_time">Poruwa Ceremony Time (If Available Only): </label>
                <input type="datetime-local" id="going_away_time" name="going_away_time" >

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
                
                <label for="location">Location Frame ( Add Iframe Src only ):</label>
                <input type="text" id="location_frame" name="location_frame" required>

                <label for="pre_shoot_images">Pre-shoot Images (up to 10 Images size of 430*631px):</label>
                <input type="file" id="pre_shoot_images" name="pre_shoot_images[]" multiple accept="image/*" required>
                
                <label for="background_sound">Background Sound:</label>
                <input type="file" id="background_sound" name="background_sound"  accept="audio/*" >
                
                <label for="color_code">Main Color Code: (Hex Values are Recommended)</label>
                <input type="text" id="color_code" name="color_code" >

                <!--<label for="invitees">Invitees (up to 100 names, separate by comma):</label>-->
                <!--<textarea id="invitees" name="invitees" rows="4" required></textarea>-->
                
                <label for="grooms_img">Groom's Image (120*120px) :</label>
                <input type="file" id="grooms_img" name="grooms_img" accept="image/*" required>
                
                <label for="brides_img">Bride's Image (120*120px) :</label>
                <input type="file" id="brides_img" name="brides_img" accept="image/*" required>
                
                <label for="opening_bg">Opening View Background Image (430*680 px) :</label>
                <input type="file" id="opening_bg" name="opening_bg" accept="image/*" required>
                
                <label for="opening_couple">Opening View Couple Image (180*180px) :</label>
                <input type="file" id="opening_couple" name="opening_couple" accept="image/*" required>

                <label for="cover_image">Cover View Background Image (430*680 px) :</label>
                <input type="file" id="cover_image" name="cover_image" accept="image/*" required>
                
                <label for="other_image">Other Background Images (430*680 px) :</label>
                <input type="file" id="other_image" name="other_image" accept="image/*" required>
                
                <label for="cover_closing">Closing View Cover Image (165*165 px) :</label>
                <input type="file" id="cover_closing" name="cover_closing" accept="image/*" required>
                
                <label for="closing_bg">Closing View Background Image (430*680 px) :</label>
                <input type="file" id="closing_bg" name="closing_bg" accept="image/*" required>
                
                <button type="submit">Create Wedding Card</button>
            </form>
        </div>



    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->


<script src="script.js"></script>
</body>
</html>
