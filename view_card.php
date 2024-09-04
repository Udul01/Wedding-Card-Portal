
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sweetcoco";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve wedding card data from the database
$sql = "SELECT * FROM wedding_cards ORDER BY id DESC LIMIT 1"; // Assuming you only want to display the latest wedding card
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $row = $result->fetch_assoc();
    $bride_name = $row["bride_name"];
    $groom_name = $row["groom_name"];
    $bride_father_name = $row["bride_father_name"];
    $bride_mother_name = $row["bride_mother_name"];
    $groom_father_name = $row["groom_father_name"];
    $groom_mother_name = $row["groom_mother_name"];
    $poruwa_ceremony_time = $row["poruwa_ceremony_time"];
    $going_away_time = $row["going_away_time"];
    $location = $row["location"];
    $pre_shoot_image1 = $row["pre_shoot_image1"];
    $pre_shoot_image2 = $row["pre_shoot_image2"];

    // Output the wedding card
    echo "<div style='width: 100%; text-align: center;'>";

    // First section with background image and bride/groom names
   

// Placeholder image URLs
$placeholder_background_image = "https://via.placeholder.com/1200x800";
$placeholder_profile_image = "https://via.placeholder.com/150";

echo "<div style='background-image: url(\"$placeholder_background_image\"); background-size: cover; background-position: center; padding: 50px; color: white; border-radius: 15px;'>";
echo "<h2 style='font-family: Arial, sans-serif;'>$bride_name & $groom_name's Wedding</h2>";

// Circle div with image and text
echo "<div style='text-align: center;'>";
echo "<div style='width: 150px; height: 150px; border-radius: 50%; overflow: hidden; margin: 0 auto;'>";
echo "<img src='$placeholder_profile_image' style='width: 100%; height: auto; object-fit: cover;'>";
echo "</div>";
echo "<p style='font-family: Arial, sans-serif;'>Dear Kasun Aiya</p>";
echo "<button style='font-family: Arial, sans-serif; background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;' onclick='openInvitation()'>Open Invitation</button>";
echo "</div>";

echo "</div>";

// Second section where invitation will appear
echo "<div id='invitationSection' style='display: none; margin-top: 30px;'>";
// Invitation content will go here
echo "</div>";





    // Second section with background image and parents' names
    echo "<div style='background-image: url(\"$pre_shoot_image1\"); background-size: cover; background-position: center; padding: 50px; color: white;'>";
    echo "<h3>Son of $groom_father_name & $groom_mother_name</h3>";
    echo "<h3>Daughter of $bride_father_name & $bride_mother_name</h3>";
    echo "</div>";

    // Third section with Poruwa ceremony and Going Away times
    echo "<div style='padding: 50px;'>";
    echo "<h3>Poruwa Ceremony Time: $poruwa_ceremony_time</h3>";
    echo "<h3>Going Away Time: $going_away_time</h3>";
    echo "</div>";

    // Fourth section with event location in an iframe
    echo "<div style='padding: 50px;'>";
    echo "<iframe src='$location' width='100%' height='400' frameborder='0' style='border:0;' allowfullscreen='' aria-hidden='false' tabindex='0'></iframe>";
    echo "</div>";

    // Fifth section with pre-shoot images as a gallery
    echo "<div style='padding: 20px;'>";
    echo "<img src='$pre_shoot_image1' alt='Pre-shoot Image 1' style='width: 100px; height: auto; margin-right: 10px;'>";
    echo "<img src='$pre_shoot_image2' alt='Pre-shoot Image 2' style='width: 100px; height: auto;'>";
    echo "</div>";

    echo "</div>"; // End of container
} else {
    echo "No wedding card found.";
}

$conn->close();
?>

<script>
function openInvitation() {
    // Simulate invitation content for demonstration
    var invitationContent = "Dear Kasun Aiya, You are cordially invited to the wedding of $bride_name and $groom_name. Please join us in celebrating this special occasion.";
    // Display invitation content in the second section
    document.getElementById('invitationSection').innerHTML = invitationContent;
    document.getElementById('invitationSection').style.display = 'block';
}
</script>