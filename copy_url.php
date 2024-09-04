<?php
// Retrieve groom's name, bride's name, and invitee's name from the URL
$brideName = $_GET['bride'];
$groomName = $_GET['groom'];
$inviteeName = $_GET['invitee'];

// Construct the URL
$url = "wedding_card.php?bride=$brideName&groom=$groomName&invitee=$inviteeName";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Copy URL</title>
</head>
<body>
    <h1>Copy URL</h1>
    <p>URL to share with <?php echo $inviteeName ?>:</p>
    <input type="text" value="<?php echo $url ?>" readonly>
</body>
</html>
