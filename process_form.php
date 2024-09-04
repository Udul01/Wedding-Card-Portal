<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweetcoco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bride_name = $_POST["bride_name"];
    $groom_name = $_POST["groom_name"];
    $bride_father_name = $_POST["bride_father_name"];
    $bride_mother_name = $_POST["bride_mother_name"];
    $groom_father_name = $_POST["groom_father_name"];
    $groom_mother_name = $_POST["groom_mother_name"];
    $poruwa_time = $_POST["poruwa_time"];
    $going_away_time = $_POST["going_away_time"];
    $location = $_POST["location"];
    $color_code = $_POST["color_code"];
    $location_frame = $_POST["location_frame"];

    // Handle pre-shoot images upload
$pre_shoot_images = array_fill(0, 7, ""); // Initialize with 7 empty strings
$target_dir = "uploads/";
if (!empty($_FILES["pre_shoot_images"]["name"][0])) {
    foreach ($_FILES["pre_shoot_images"]["tmp_name"] as $key => $tmp_name) {
        $target_file = $target_dir . basename($_FILES["pre_shoot_images"]["name"][$key]);
        if (move_uploaded_file($_FILES["pre_shoot_images"]["tmp_name"][$key], $target_file)) {
            $pre_shoot_images[$key] = $target_file;
        }
    }
}

// Ensure the array has exactly 7 elements (even if fewer images were uploaded)
for ($i = count($pre_shoot_images); $i < 7; $i++) {
    $pre_shoot_images[$i] = "";
}


    // Handle opening background image upload
    $opening_bg = "";
    if (isset($_FILES["opening_bg"]) && $_FILES["opening_bg"]["size"] > 0) {
        $target_dir = "uploads/bg/";
        $target_file = $target_dir . basename($_FILES["opening_bg"]["name"]);
        if (move_uploaded_file($_FILES["opening_bg"]["tmp_name"], $target_file)) {
            $opening_bg = $target_file;
        }
    }

    // Handle opening couple image upload
    $opening_couple = "";
    if (isset($_FILES["opening_couple"]) && $_FILES["opening_couple"]["size"] > 0) {
        $target_dir = "uploads/bg/";
        $target_file = $target_dir . basename($_FILES["opening_couple"]["name"]);
        if (move_uploaded_file($_FILES["opening_couple"]["tmp_name"], $target_file)) {
            $opening_couple = $target_file;
        }
    }

    // Handle cover image upload
    $cover_image = "";
    if (isset($_FILES["cover_image"]) && $_FILES["cover_image"]["size"] > 0) {
        $target_dir = "uploads/bg/";
        $target_file = $target_dir . basename($_FILES["cover_image"]["name"]);
        if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file)) {
            $cover_image = $target_file;
        }
    }

    // Handle closing image upload
    $cover_closing = "";
    if (isset($_FILES["cover_closing"]) && $_FILES["cover_closing"]["size"] > 0) {
        $target_dir = "uploads/bg/";
        $target_file = $target_dir . basename($_FILES["cover_closing"]["name"]);
        if (move_uploaded_file($_FILES["cover_closing"]["tmp_name"], $target_file)) {
            $cover_closing = $target_file;
        }
    }

    // Handle closing bg image upload
    $closing_bg = "";
    if (isset($_FILES["closing_bg"]) && $_FILES["closing_bg"]["size"] > 0) {
        $target_dir = "uploads/bg/";
        $target_file = $target_dir . basename($_FILES["closing_bg"]["name"]);
        if (move_uploaded_file($_FILES["closing_bg"]["tmp_name"], $target_file)) {
            $closing_bg = $target_file;
        }
    }
    
        // Handle closing bg image upload
    $other_image = "";
    if (isset($_FILES["other_image"]) && $_FILES["other_image"]["size"] > 0) {
        $target_dir = "uploads/bg/";
        $target_file = $target_dir . basename($_FILES["other_image"]["name"]);
        if (move_uploaded_file($_FILES["other_image"]["tmp_name"], $target_file)) {
            $other_image = $target_file;
        }
    }

    // Handle grooms image upload
    $grooms_img = "";
    if (isset($_FILES["grooms_img"]) && $_FILES["grooms_img"]["size"] > 0) {
        $target_dir = "uploads/bg/";
        $target_file = $target_dir . basename($_FILES["grooms_img"]["name"]);
        if (move_uploaded_file($_FILES["grooms_img"]["tmp_name"], $target_file)) {
            $grooms_img = $target_file;
        }
    }

    // Handle brides bg image upload
    $brides_img = "";
    if (isset($_FILES["brides_img"]) && $_FILES["brides_img"]["size"] > 0) {
        $target_dir = "uploads/bg/";
        $target_file = $target_dir . basename($_FILES["brides_img"]["name"]);
        if (move_uploaded_file($_FILES["brides_img"]["tmp_name"], $target_file)) {
            $brides_img = $target_file;
        }
    }

    // Handle soundtrack upload
    $soundtrack_file = "";
    if (isset($_FILES["background_sound"]) && $_FILES["background_sound"]["size"] > 0) {
        $soundtrack_dir = "soundtracks/";
        $soundtrack_file = $soundtrack_dir . basename($_FILES["background_sound"]["name"]);
        move_uploaded_file($_FILES["background_sound"]["tmp_name"], $soundtrack_file);
    }

    // Handle invitees
    $invitees = $_POST["invitees"];

    // Prepare and execute SQL statement
$stmt = $conn->prepare("INSERT INTO wedding_cards (
    bride_name, groom_name, bride_father_name, bride_mother_name, groom_father_name, groom_mother_name,
    poruwa_ceremony_time, going_away_time, location, pre_shoot_image1, pre_shoot_image2, pre_shoot_image3,
    pre_shoot_image4, pre_shoot_image5, pre_shoot_image6, pre_shoot_image7, invitees, background_sound,
    color_code, opening_bg, opening_couple, cover_image, cover_closing, closing_bg, grooms_img, brides_img,
    location_frame, other_image
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("ssssssssssssssssssssssssssss",
        $bride_name, $groom_name, $bride_father_name, $bride_mother_name, $groom_father_name, $groom_mother_name,
        $poruwa_time, $going_away_time, $location, $pre_shoot_images[0], $pre_shoot_images[1], $pre_shoot_images[2],
        $pre_shoot_images[3], $pre_shoot_images[4], $pre_shoot_images[5], $pre_shoot_images[6], $invitees,
        $soundtrack_file, $color_code, $opening_bg, $opening_couple, $cover_image, $cover_closing, $closing_bg,
        $grooms_img, $brides_img, $location_frame, $other_image
    );

        if ($stmt->execute()) {
            // Display success message
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Card is Ready</title>
            </head>
            <body style=\"background-image: url('./images/wed.jpg'); background-size: cover; background-position: center; height: 100vh; width: 100%;\">
                <div style='text-align:center;'>
                    <h2 style='font-family: Arial, sans-serif; color: #fff; padding-top: 80px; font-size: 24px; margin-bottom: 20px;'>Wedding card has been created successfully!</h2>
                    <h4 style='font-family: Arial, sans-serif; color: #100f0f; font-size: 18px; margin-bottom: 20px;'>You can view the card by clicking the button below</h4>
                    <button onclick='window.location.href=\"card.php\"' style='background-color: #100f0f; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 10px;'>View Card</button>
                </div>
            </body>
            </html>";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "No POST request received.";
}
?>
