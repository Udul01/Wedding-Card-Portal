<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Card</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./weddingCardStyles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
   /* Your custom styles here */
  .arrow-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 24px;
    color: #000;
    padding: 5px;
    font-weight: bold; /* Added font weight */
  }

  .left-arrow {
    left: 10px; /* Adjusted positioning */
  }

  .right-arrow {
    right: 10px; /* Adjusted positioning */
  }

  .arrow-btn i {
    font-size: 1.5rem; /* Adjusted icon size */
  }
</style>
   
   <style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(-40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

   <style>
    @keyframes fadeInleft {
        from {
            opacity: 0;
            transform: translateX(-40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>
  <style>
  @keyframes slideInFromBottom {
    0% {
        transform: translateY(100%);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

        </style>
        
    <style>
    @keyframes fadeInright {
        from {
            opacity: 0;
            transform: translateX(-40px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>
        <style>
            
            .section {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.section.active {
    opacity: 1;
}

.slide-in {
    animation: slideInFromBottom 0.7s ease-in-out forwards;
}

@keyframes slideInFromBottom {
    0% {
        transform: translateY(100%);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

        </style>
        
        
        
        
        <style>
    /* Add custom CSS for horizontal scrolling for "Wishes" and "Closing" sections */
    #wishies .sectionContent,
    #closing .sectionContent {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }

    /* Ensure proper width for each section content */
    #wishies .sectionContent > * {
        flex: 0 0 auto;
        width: 100%;
    }

    /* Additional styles for the horizontal scrolling container */
    .sectionContent {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
    }

    .sectionContent > * {
        scroll-snap-align: center;
    }

    /* Ensure each section content takes full height of the parent */
    .sectionContent > * {
        height: 100%;
    }
</style>
        
        
        
    <style>
        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        .navbarBottomPosition {
            position: absolute;
            bottom: 0;
            transition: transform 0.3s ease-in-out;
            z-index: 999;
        }

        .bodyWrapper {
            position: relative;
            width: 430px;
        }

        .heroSection {
            display: block;
        }

        .navbarBottomPosition::-webkit-scrollbar {
            width: 0;
            height: 0;
            background: transparent;
        }

        /* Track */
        .navbarBottomPosition::-webkit-scrollbar-track {
            background: transparent;
        }

        /* Handle */
        .navbarBottomPosition::-webkit-scrollbar-thumb {
            background: transparent;
        }

        .navOnPages {
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            transition: transform 0.3s ease-in-out;
        }
    </style>
    
    

</head>

<body class="p-0 m-0">
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

        // Function to update wish status
        function updateWishStatus($conn, $id, $status) {
            $sql_update = "UPDATE wedding_cards SET status = $status WHERE id = $id";
            if ($conn->query($sql_update) === TRUE) {
                echo "Wish status updated successfully";
            } else {
                echo "Error updating wish status: " . $conn->error;
            }
        }

        // Check if approve or reject button clicked
        if (isset($_GET['action']) && isset($_GET['id'])) {
            $action = $_GET['action'];
            $id = $_GET['id'];
            if ($action == 'approve') {
                updateWishStatus($conn, $id, 1); // Set status to approved (1)
            } elseif ($action == 'reject') {
                updateWishStatus($conn, $id, 0); // Set status to rejected (0)
            }
        }

        // Retrieve wedding card data based on ID from the URL
        $id = $_GET['id'];
        $sql = "SELECT * FROM wedding_cards WHERE id = $id";
        $result = $conn->query($sql);

        
        
        if ($result->num_rows > 0) {
    // Output the wedding card
    $row = $result->fetch_assoc();

    ?>

  
<style>
<?php if($row['color_code'] != null){ ?>
.navbarBottom a:hover, .activeBtn a {
    background-color: <?php echo $row['color_code'] ?> !important;
}
.title-style-6 {
    color: <?php echo $row['color_code'] ?> !important;
}
<?php } ?>
</style>


    
    <div class="bodyWrapper" style="min-height:100vh;overflow-y: hidden;">

        <div id="heroSection" class="flex-column welcome-content heroSection"
            style="background-image: url('<?php echo $row['opening_bg']; ?>');" >
           
            <div class="overlay"></div>
            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center justify-content-around"
                style="z-index: 99;">
                <h2 class="text-white title-style-1"><?php echo $row['bride_name'] . " & " . $row['groom_name']; ?></h2>
                <!--<img src="./images/WhatsApp Image 2024-05-09 at 11.06.49_a53e28cd.jpg" alt="" class="welcomeCoupleImage"> -->
                 <img src="<?php echo htmlspecialchars($row['opening_couple']); ?>" alt="Opening Background" class="welcomeCoupleImage">
                <button onclick="showNavigation(),togglePlayPause()">Open invitation</button>

            </div>
        </div>
        
    <!--      <audio id="myAudio" autoplay>-->
    <!--    <source src="./images/Perfect-(PagalSongs.Com.IN).mp3" type="audio/mpeg">-->
    <!--    Your browser does not support the audio element.-->
    <!--</audio>-->
        
<style>
    /* Style for the audio player container */
    .audio {
    position: absolute;
    bottom: 80px;
    right: 20px;
    z-index: 9999;
    }

    /* Style for the play/pause button */
    #playStopButton {
        text-align: center;
        background-color: #fff;
        color: #333;
        margin-top: 10px;
        width: 45px;
        height: 45px;
        border-radius: 45px;
        border: 1px solid #cdcdcd;
        box-shadow: 0px 0px 3px 1px rgba(0,0,0,0.3);
        padding: 9px;
    }

    /* Style for the play/pause icon */
    #playStopIcon {
        width: 90%;
        margin-top: -2px;
    }
</style>


<div class="audio" id="audiobtn" style="display:none;">
    <audio id="myAudio" autoplay>

         <?php if($row['background_sound'] != null){ ?>
        <source src="./<?php echo $row['background_sound'] ?>" type="audio/mpeg">
        <?php } else { ?>
        <source src="./images/Perfect-(PagalSongs.Com.IN).mp3" type="audio/mpeg">
        <?php } ?>
        
        Your browser does not support the audio element.
    </audio>

    <button id="playStopButton" onclick="togglePlayPause()">
        <img id="playStopIcon" src="./images/sound.png" alt="Sound Icon">
    </button>
</div>

<script>
    var audio = document.getElementById("myAudio");
    var playStopIcon = document.getElementById("playStopIcon");

    function togglePlayPause() {
        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
        }
        
        // Update the button icon based on audio state and mute status
        if (audio.paused || audio.muted) {
            playStopIcon.src = "./images/mute.png"; // If audio is paused or muted, show sound icon
        } else {
            playStopIcon.src = "./images/sound.png"; // If audio is playing and not muted, show mute icon
        }
    }

    audio.onvolumechange = function() {
        if (audio.muted) {
            playStopIcon.src = "./images/sound.png";
        } else {
            playStopIcon.src = "./images/mute.png";
        }
    };
</script>


<!--     <div class="navOnPages w-100 navbarBottomPosition" style="z-index: 999; overflow-x: auto;" id="navigation">-->

<!--    <button class="arrow-btn left-arrow" onclick="scrollMenu('left')" >-->
<!--        <i class="fas fa-chevron-left arrow-icon"></i>-->
<!--    </button>-->
<!--    <div class="d-flex  flex-row w-100">-->
<!--        <div class="col-2 navbarBottom activeBtn">-->
<!--            <a href="#cover" data-target="cover" class="nav-link">-->
<!--                <i class="bi bi-book"></i>-->
<!--                Cover-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-2 navbarBottom">-->
<!--            <a href="#couple" data-target="couple" class="nav-link">-->
<!--                <i class="bi bi-heart-fill"></i>-->
<!--                Couple-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-2 navbarBottom">-->
<!--            <a href="#event" data-target="event" class="nav-link">-->
<!--                <i class="bi bi-calendar-event-fill"></i>-->
<!--                Event-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-2 navbarBottom">-->
<!--            <a href="#map" data-target="map" class="nav-link">-->
<!--                <i class="bi bi-map-fill"></i>-->
<!--                Map-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-2 navbarBottom">-->
<!--            <a href="#gallery" data-target="gallery" class="nav-link">-->
<!--                <i class="bi bi-image-fill"></i>-->
<!--                Gallery-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-2 navbarBottom">-->
<!--            <a href="#wishies" data-target="wishies" class="nav-link">-->
<!--                <i class="bi bi-pencil-square"></i>-->
<!--                Wishes-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-2 navbarBottom">-->
<!--            <a href="#closing" data-target="closing" class="nav-link">-->
<!--             <i class="bi bi-x-circle-fill"></i>-->
<!--                Closing-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--     <button class="arrow-btn right-arrow" onclick="scrollMenu('right')">-->
<!--        <i class="fas fa-chevron-right arrow-icon"></i>-->
<!--    </button>-->
    
<!--</div>-->

<div class="navOnPages w-100 navbarBottomPosition nav-whidth" style="z-index: 999; overflow-x: auto;" id="navigation">
                <!--<div class="outer" style="position:relative;">-->
               
                <div class="d-flex  flex-row w-100">
                    <div class="col-2 navbarBottom activeBtn" id="1st">
                        <a href="#cover" data-target="cover" class="nav-link">
                            <i class="bi bi-book"></i>
                            Cover
                        </a>
                    </div>
                    <div class="col-2 navbarBottom" id="2nd">
                        <a href="#couple" data-target="couple" class="nav-link">
                            <i class="bi bi-heart-fill"></i>
                            Couple
                        </a>
                    </div>
                    <div class="col-2 navbarBottom">
                        <a href="#event" data-target="event" class="nav-link">
                            <i class="bi bi-calendar-event-fill"></i>
                            Event
                        </a>
                    </div>
                    <div class="col-2 navbarBottom">
                        <a href="#map" data-target="map" class="nav-link">
                            <i class="bi bi-map-fill"></i>
                            Map
                        </a>
                    </div>
                    <div class="col-2 navbarBottom">
                        <a href="#gallery" data-target="gallery" class="nav-link">
                            <i class="bi bi-image-fill"></i>
                            Gallery
                        </a>
                    </div>
                    <div class="col-2 navbarBottom">
                        <a href="#wishies" data-target="wishies" class="nav-link">
                            <i class="bi bi-pencil-square"></i>
                            Wishes
                        </a>
                    </div>
                    <div class="col-2 navbarBottom">
                        <a href="#closing" data-target="closing" class="nav-link">
                            <i class="bi bi-x-circle-fill"></i>
                            Closing
                        </a>
                    </div>
                </div>
                <div class="d-flex justify-content-between scroll-sec-nav-arrow">
                    <button style="left:10px;" class="arrow-btn left-arrow" onclick="scrollMenu('left')">
                        <i class="fas fa-chevron-left arrow-icon"></i>
                    </button>
                    <button class="arrow-btn right-arrow" onclick="scrollMenu('right')">
                        <i class="fas fa-chevron-right arrow-icon"></i>
                    </button>
                </div>
  </div>
        
        <!--navbar bottom start-->
       
        <!--<div class="navOnPages w-100 navbarBottomPosition" style="z-index: 999; display: none;" id="navigation">-->
        <!--    <div class="d-flex  flex-row w-100 ">-->
        <!--        <div class="col-2 navbarBottom activeBtn">-->
        <!--            <a href="#cover" data-target="cover" class="nav-link">-->
        <!--                <i class="bi bi-book"></i>-->
        <!--                Cover-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="col-2 navbarBottom">-->
        <!--            <a href="#couple" data-target="couple" class="nav-link">-->
        <!--                <i class="bi bi-heart-fill"></i>-->
        <!--                Couple-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="col-2 navbarBottom">-->
        <!--            <a href="#event" data-target="event" class="nav-link">-->
        <!--                <i class="bi bi-calendar-event-fill"></i>-->
        <!--                Event-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="col-2 navbarBottom">-->
        <!--            <a href="#map" data-target="map" class="nav-link">-->
        <!--                <i class="bi bi-map-fill"></i>-->
        <!--                Map-->
        <!--            </a>-->
        <!--        </div>-->
              
        <!--        <div class="col-2 navbarBottom">-->
        <!--            <a href="#gallery" data-target="gallery" class="nav-link">-->
        <!--                <i class="bi bi-image-fill"></i>-->
        <!--                Gallery-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="col-2 navbarBottom">-->
        <!--            <a href="#wishies" data-target="wishies" class="nav-link">-->
        <!--                <i class="bi bi-pencil-square"></i>-->
        <!--                Wishes-->
        <!--            </a>-->
        <!--        </div>-->
        <!--        <div class="col-2 navbarBottom">-->
        <!--            <a href="#closing" data-target="closing" class="nav-link">-->
        <!--             <i class="bi bi-x-circle-fill"></i>-->
        <!--                Closing-->
        <!--            </a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--navbar bottom end-->

        <div id="cover" class="section active">
            <div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">
                <div class="d-flex flex-column welcome-content pb-5"
                      style="background-image: url('<?php echo $row['opening_bg']; ?>');">  

                    <!--style="background-image: url('./images/page2bg.png');"> -->
                    <div class="overlay"></div>
                    <div class="d-flex flex-column align-items-center justify-content-end h-100 text-center"
                        style="z-index: 99;">
                        <!--<div class="d-flex flex-column mb-5">-->
                        <!--    <h4 class="mb-3 title-style-2 text-uppercase">THE WEDDING OF</h4>-->
                        <!--    <h2 class="title-style-1"><?php echo $row['bride_name'] . " & " . $row['groom_name']; ?></h2>-->
                        <!--    <p class="title-style-4">Tuesday, February 19th 2024</p> -->
                        <!--</div>-->
                        
                        <div class="d-flex flex-column mb-5">
    <h4 class="mb-3 title-style-2 text-uppercase"  style=" font-size: 14px;color: #ffffff;font-weight:0;opacity: 0; transform: translateY(-50px); animation: fadeInUp 1.2s ease forwards;">THE WEDDING OF</h4>
    <h2 class="title-style-1"  style="opacity: 0; transform: translateY(-50px); animation: fadeInUp 1.5s ease forwards;"><?php echo $row['bride_name'] . " & " . $row['groom_name']; ?></h2>
    <!--<p class="title-style-4"  style="opacity: 0; transform: translateY(-50px); animation: fadeInUp 1.8s ease forwards;">Tuesday, February 19th 2024</p> -->
    <p class="title-style-4" style="opacity: 0; transform: translateY(-50px); animation: fadeInUp 1.8s ease forwards;">
    <?php 
        // Get the date from $row['going_away_time']
        $date = strtotime($row['going_away_time']);
        
        // Format the date to display in the desired format
        $formatted_date = date("l, F jS Y", $date);
        
        echo $formatted_date;
    ?>
</p>

</div>

                        <div class="d-flex flex-column mb-5">
                            <a class="nav-link"  style="color:#dadadb !important;"  onclick="activateSection()">
                                   
                                <i class="bi bi-chevron-double-up"></i>
                                <br>
                                Swip up
                            </a>
                        </div>
                        
       <!--<a href="#couple" data-target="couple" class="nav-link">-->

                    </div>
                </div>
            </div>
        </div>
        <div id="couple" class="section">
            <div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">
                <div class="d-flex flex-column welcome-content" style="background-image: url('<?php echo $row['other_image']; ?>');">
                <!--style="background-image: url('./images/bg.png');">-->
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center shadow-lg m-3 p-3"
                        style="z-index: 99; border-radius: 10px; filter: drop-shadow(0px 3px 3.5px rgba(0,0,0,0.42));">


                        <div class="d-flex flex-column mb-5">
                            <p class="title-style-5" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards;" >Together with our parents,
                                we request the honor of your presence at
                                our wedding reception
                            </p>
                            <div class="d-flex flex-row py-3">
                                <div class="col-5">
                                    <!--<img src="./images/profilePic.png" alt="" class="welcomeCoupleImage" -->
                                    <img src="<?php echo $row['grooms_img']; ?>" alt="" class="welcomeCoupleImage"

                                        style="width:120px; height:120px;opacity: 0; transform: translateY(50px); animation: slideInFromBottom 1.5s ease forwards;">
                                </div>
                                <div class="col-7">
                                    <h2 class="title-style-6"style="opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;"><?php echo $row['groom_name']; ?></h2>
                                    <p class="title-style-5" style="opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards; ">Son of <br>
                                        <!--Mr. & Mrs. -->
                                        <?php echo $row['groom_father_name']; ?></p>
                                </div>
                            </div>
                            <h2 class="title-style-1" style="color: #000">&</h2>
                            <div class="d-flex flex-row py-3">
                                <div class="col-7">
                                    <h2 class="title-style-6" style="opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;"><?php echo $row['bride_name']; ?></h2>
                                    <p class="title-style-5" style="opacity: 0; transform: translateY(50px); animation: fadeInright 2.2s ease forwards;" >Daughter of <br>
                                        <!--Mr. & Mrs.-->
                                        <?php echo $row['bride_father_name']; ?></p>
                                </div>
                                <div class="col-5">
                                   <img src="<?php echo $row['brides_img']; ?>" alt="" class="welcomeCoupleImage"
                                        style="width:120px; height:120px;opacity: 0; transform: translateY(50px); animation: slideInFromBottom 1.5s ease forwards;">
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="event" class="section">
            <div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">
                <div class="d-flex flex-column welcome-content" style="background-image: url('<?php echo $row['other_image']; ?>');">
                <!--style="background-image: url('./images/bg.png');">-->
                    <!-- <div class="overlay"></div> -->
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center shadow-lg m-3 p-3"
                        style="z-index: 99; border-radius: 10px; filter: drop-shadow(0px 3px 3.5px rgba(0,0,0,0.42));">
                        <div class="d-flex flex-column mb-3 w-100">
                            <h2 class="title-style-6"  style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards;">  Reception</h2>
                            <div class="d-flex flex-row my-3 w-100">
                                <div class="col-5 text-end pe-3">
                                    <p class="title-style-3" style="color: #000; opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;">
                                       <?php
$day_of_week = date('l', strtotime($row['poruwa_ceremony_time']));
echo $day_of_week;
?>
                                    </p>
                                    <hr>
                                    <p class="title-style-8 mb-0" style="color: #000; opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;">
                                        <!--<?php echo $row['going_away_time']; ?>-->
                                        <?php echo date('h:i A', strtotime($row['poruwa_ceremony_time'])); ?>
                                    </p>

                                </div>
                                <div class="col-2">
                                    <h2 class="title-style-1 dateStyle"  style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards;"><?php
$day_of_month = date('d', strtotime($row['poruwa_ceremony_time']));
echo $day_of_month;
?></h2>
                                </div>
                                <div class="col-4 text-start ps-3">
                                    <p class="title-style-3" style="color: #000; opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;">
                                        <!--Friday-->
<?php
$month = date('F', strtotime($row['poruwa_ceremony_time']));
echo $month;
?>
                                    </p>
                                    <hr>
                                    <p class="title-style-8 mb-0" style="color: #000; opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;">2024</p>

                                </div>
                            </div>
                            <p class="title-style-8 mb-0" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards;"><?php echo $row['location']; ?></p>
                            <!--<p class="title-style-8 mb-0">57 Kurunegala - Dambulla Rd</p>-->
                            <!--<p class="title-style-8 mb-0 mb-4">Badagamuwa 6000</p>-->


                            
                       
                       
                       <?php if (!empty($row['going_away_time'])): ?>
                       <h2 class="title-style-6" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards; margin-top:70px;">Poruwa Ceremony </h2>
<div class="d-flex flex-row my-3 w-100 mb-4">
    <div class="col-5 text-end pe-3">
        <p class="title-style-3" style="color: #000; opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;">
            <?php
            $day_of_week = date('l', strtotime($row['going_away_time']));
            echo $day_of_week;
            ?>
        </p>
        <hr>
        <p class="title-style-8 mb-0" style="color: #000; opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;">
            <!--<?php echo $row['poruwa_ceremony_time']; ?>-->
            <?php echo date('h:i A', strtotime($row['going_away_time'])); ?>
        </p>
    </div>
    <div class="col-2">
        <h2 class="title-style-1 dateStyle" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards;">
            <?php
            $day_of_month = date('d', strtotime($row['going_away_time']));
            echo $day_of_month;
            ?>
        </h2>
    </div>
    <div class="col-4 text-start ps-3">
        <p class="title-style-3" style="color: #000; opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;">
            <?php
            $month = date('F', strtotime($row['going_away_time']));
            echo $month;
            ?>
        </p>
        <hr>
        <p class="title-style-8 mb-0" style="color: #000; opacity: 0; transform: translateY(50px); animation: fadeInleft 2.2s ease forwards;">2024</p>
    </div>
</div>
 <p class="title-style-8 mb-0" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards;"><?php echo $row['location']; ?></p>
<?php endif; ?>

                       
                            <!--<p class="title-style-8 mb-0" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards;">Royal Crown</p>-->
                           
                            <!--<p class="title-style-8 mb-0">Badagamuwa 6000</p>-->

                            <!--<div class="d-flex flex-row w-100 mt-3">-->
                            <!--    <div class="col p-1 countDownBox">-->
                            <!--        <p class="title-style-8 mb-0">-->
                            <!--            08-->
                            <!--            <br>-->
                            <!--            Days-->
                            <!--        </p>-->
                            <!--    </div>-->
                            <!--    <div class="col p-1 countDownBox">-->
                            <!--        <p class="title-style-8 mb-0">-->
                            <!--            04-->
                            <!--            <br>-->
                            <!--            Hours-->
                            <!--        </p>-->
                            <!--    </div>-->
                            <!--    <div class="col p-1 countDownBox">-->
                            <!--        <p class="title-style-8 mb-0">-->
                            <!--            25-->
                            <!--            <br>-->
                            <!--            Minutes-->
                            <!--        </p>-->
                            <!--    </div>-->
                            <!--    <div class="col p-1 countDownBox">-->
                            <!--        <p class="title-style-8 mb-0">-->
                            <!--            00-->
                            <!--            <br>-->
                            <!--            Seconds-->
                            <!--        </p>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
       
    <div class="d-flex flex-row w-100 mt-3">
        <div class="col p-1 countDownBox">
            <p class="title-style-8 mb-0" id="days">00<br>Days</p>
        </div>
        <div class="col p-1 countDownBox">
            <p class="title-style-8 mb-0" id="hours">00<br>Hours</p>
        </div>
        <div class="col p-1 countDownBox">
            <p class="title-style-8 mb-0" id="minutes">00<br>Minutes</p>
        </div>
        <div class="col p-1 countDownBox">
            <p class="title-style-8 mb-0" id="seconds">00<br>Seconds</p>
        </div>
    </div>
<?php 

 $going_away_time = $row['going_away_time'];
 $date = new DateTime($going_away_time);
 $formatted_date = $date->format('F d, Y H:i:s');
?>

<input type="hidden" id="timedate" value="<?php echo $formatted_date ?>" >

          <script>

        const targetDateString = document.getElementById("timedate").value;
        const targetDate = new Date(targetDateString).getTime();


        const countdown = setInterval(function() {
            // Get today's date and time
            const now = new Date().getTime();

      
            const distance = targetDate - now;


            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in elements with corresponding IDs
            document.getElementById("days").innerHTML = days + "<br>Days";
            document.getElementById("hours").innerHTML = hours + "<br>Hours";
            document.getElementById("minutes").innerHTML = minutes + "<br>Minutes";
            document.getElementById("seconds").innerHTML = seconds + "<br>Seconds";

            // If the countdown is finished, write some text
            if (distance < 0) {
                clearInterval(countdown);
                document.getElementById("days").innerHTML = "00<br>Days";
                document.getElementById("hours").innerHTML = "00<br>Hours";
                document.getElementById("minutes").innerHTML = "00<br>Minutes";
                document.getElementById("seconds").innerHTML = "00<br>Seconds";
            }
        }, 1000);
    </script>
      
    
    <!--end-->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="map" class="section">
            <div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">
                <div class="d-flex flex-column welcome-content" style="background-image: url('<?php echo $row['other_image']; ?>');">
                <!--style="background-image: url('./images/bg.png');">-->
                    <!-- <div class="overlay"></div> -->
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center shadow-lg m-3 p-3"
                        style="z-index: 99; border-radius: 10px; filter: drop-shadow(0px 3px 3.5px rgba(0,0,0,0.42));">

                        <div class="d-flex flex-column mb-5">
                            <h2 class="title-style-6" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.0s ease forwards;">Map</h2>
                            <h3 class="title-style-7"  style="opacity: 0; transform: translateY(50px); animation: slideInFromBottom 2.0s ease forwards;"></h3>
                            <p class="title-style-8"   style="opacity: 0; transform: translateY(50px); animation: slideInFromBottom 2.0s ease forwards;"><?php echo $row['location']; ?></p>
                            <!--<iframe src='" . $row['location'] . "' class="mapIframe mb-3" width="300" height="300" scrolling="no" frameborder='0' marginheight="0" marginwidth="0" allowfullscreen='' aria-hidden='false' tabindex='0'></iframe>-->
                            <!--<iframe  style="opacity: 0; transform: translateY(50px); animation: slideInFromBottom 2.0s ease forwards;" class="mapIframe mb-3" width="300" height="300" frameborder="0" scrolling="no"-->
                            <!--    marginheight="0" marginwidth="0"-->
                            <!--    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.8963483741854!2d79.9080390741168!3d6.782467420101574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2457ad82eca25%3A0x904aaafa62ba3bc8!2sParadise%20Inn%20Bolgoda!5e0!3m2!1sen!2slk!4v1715082527749!5m2!1sen!2slk"><a-->
                            <!--        href="https://www.gps.ie/">gps trackers</a></iframe>-->

                   <iframe src="<?php echo $row['location_frame']; ?>" class="mapIframe mb-3" width="300" height="350" scrolling="no" frameborder="0" marginheight="0" marginwidth="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>


<a href="<?php echo $row['location_frame']; ?>" target="_blank" rel="noopener noreferrer">
    <button class="mapButton"><i class="bi bi-map"></i> Open map</button>
</a>



                        <!--  <a href="https://maps.app.goo.gl/uooGNnFama378MA76" target="_blank" rel="noopener noreferrer">  <button class="mapButton"><i class="bi bi-map"></i> Open map</button> </a>-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--<div id="filter" class="section">-->
        <!--    <div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">-->
        <!--        <div class="d-flex flex-column welcome-content" style="background-image: url('./images/bg.png');">-->
           
        <!--            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center shadow-lg m-3 p-3"-->
        <!--                style="z-index: 99; border-radius: 10px; filter: drop-shadow(0px 3px 3.5px rgba(0,0,0,0.42));">-->
                      


        <!--                <div class="d-flex flex-column mb-5">-->
        <!--                    <h2 class="title-style-6">Wedding Filter</h2>-->
        <!--                    <p class="title-style-8">Share the special moment of the day by using <br>-->
        <!--                        our instargram wedding filter below</p>-->
        <!--                    <button class="mapButton"><i class="bi bi-instagram"></i> Open filter</button>-->
        <!--                </div>-->

        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <style>
        /* Add your custom styles here */
        .section {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .section.active {
            opacity: 1;
        }
    </style>

<style>
    /* CSS for hover effects and selected image */
    .gallery-thumbnail {
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .gallery-thumbnail:hover {
        transform: scale(1.1);
    }

    .selected-thumbnail {
        border: 2px solid #007bff; /* Blue border for selected image */
    }
</style>



<style>
        /* CSS for selected thumbnail */
        .selected-thumbnail {
            border: 2px solid blue; /* Example border styling */
        }
        /* CSS for dark overlay on unselected thumbnails */
        .gallery-thumbnail {
            position: relative;
        }
        .gallery-thumbnail:not(.selected-thumbnail)::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
        }
    </style>

<div id="gallery" class="section">
    <div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">
        <div class="d-flex flex-column welcome-content" style="background-image: url('./images/bg.png');">
            <div class="d-flex flex-column">
                <img id="mainImage" src="<?php echo $row['pre_shoot_image1']; ?>" alt="" class="img-fluid gallery-image" style="width:100%; height:81vh">
            </div>
            <div class="d-flex flex-row" id="thumbnailContainer">
                <div class="col-2">
                    <img src="<?php echo $row['pre_shoot_image2']; ?>" alt="" class="img-fluid gallery-thumbnail" style="width:100%; height:12vh" data-index="1">
                </div>
                <div class="col-2">
                    <img src="<?php echo $row['pre_shoot_image3']; ?>" alt="" class="img-fluid gallery-thumbnail" style="width:100%; height:12vh" data-index="2">
                </div>
                <div class="col-2">
                    <img src="<?php echo $row['pre_shoot_image4']; ?>" alt="" class="img-fluid gallery-thumbnail" style="width:100%; height:12vh" data-index="3">
                </div>
                <div class="col-2">
                    <img src="<?php echo $row['pre_shoot_image5']; ?>" alt="" class="img-fluid gallery-thumbnail" style="width:100%; height:12vh" data-index="4">
                </div>
                <div class="col-2">
                    <img src="<?php echo $row['pre_shoot_image6']; ?>" alt="" class="img-fluid gallery-thumbnail" style="width:100%; height:12vh" data-index="5">
                </div>
                <div class="col-2">
                    <img src="<?php echo $row['pre_shoot_image7']; ?>" alt="" class="img-fluid gallery-thumbnail" style="width:100%; height:12vh" data-index="6">
                </div>
                <!-- Add more thumbnails with data-index attribute indicating their index -->
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.gallery-thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                mainImage.src = this.src;
            });
        });
    });
</script>



        
        
        
     <div id="wishies" class="section">
    <div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">
        <div class="d-flex flex-column welcome-content" style="background-image: url('<?php echo $row['other_image']; ?>');">
        <!--style="background-image: url('./images/bg.png');">-->
            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center shadow-lg m-3 p-3"
                style="z-index: 99; border-radius: 10px; filter: drop-shadow(0px 3px 3.5px rgba(0,0,0,0.42));">
                <div class="d-flex flex-column mb-5">
                    <h2 class="title-style-6 mb-4" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 1.8s ease forwards;">Wishes & RSVP</h2>
                    <p class="title-style-8" style="width: 100%; opacity: 0; transform: translateY(50px); animation: slideInFromBottom 2.5s ease forwards;font-family:TenorSans-Regula !important;" >Thank you for keeping us in your thoughts  <br>
and your words means a lot.
                        <br>
                    </p>
                    <!--<button class="mapButton my-5" style="width: 100%; opacity: 0; transform: translateY(50px); animation: slideInFromBottom 2.5s ease forwards;"><i class="bi bi-map"></i> Write wishes &-->
                    <!--    RSVP</button>-->
                    
                 
                    <button class="mapButton my-5" id="showWishFormBtn" style="width: 100%; opacity: 0; transform: translateY(50px); animation: slideInFromBottom 2.5s ease forwards;">
    <i class="bi bi-map"></i> Write wishes & RSVP
</button>

<!--<form id="wishForm" action="process_wish.php" method="POST" style="display: none;">-->
    <!--<input type="hidden" name="card_id" id="card_id">-->
<!--    <input type='hidden' name='card_id' value='" . $_GET['id'] . "'>-->
<!--    <label for="wish">Your Wish:</label>-->
<!--    <textarea id="wish" name="wish" rows="4" placeholder="Add your wish to the couple..." required></textarea><br>-->
<!--    <button type="submit">Submit Wish</button>-->
<!--</form>-->
<style>
    #wishForm {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px; /* Adjust as needed */
    }
    
    #wishForm label {
        margin-bottom: 10px; /* Adjust as needed */
    }

    #wishForm textarea {
        width: 100%;
        max-width: 400px; /* Adjust as needed */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
    }

    #wishForm select,
    #wishForm button {
        width: 100%;
        max-width: 400px; /* Adjust as needed */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 5px;
    }

    #wishForm button {
        background-color: #065308; /* Adjust as needed */
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #wishForm button:hover {
        background-color: #0056b3; /* Adjust as needed */
    }
</style>


<div id="popupContainer" style="background-color: rgba(0, 0, 0, 0.5); position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: none; justify-content: center; align-items: center;">
    <div id="wishFormPopup" style="background-color: white; padding: 20px; border-radius: 5px;">
       <form id="wishForm" action="process_wish.php" method="POST">
    <input type="hidden" name="card_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required>

    <label style="margin-top: 12px;" for="attendance">Confirmation of Attendance:</label>
    <select id="attendance" name="attendance" required>
        <option value="">Select</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select>
    
    <label style="margin-top: 12px;" for="attendanceCount">Choose Attendance Count:</label>
    <select id="attendanceCount" name="attendance_count" required>
        <option value="">Select</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <label style="margin-top: 12px;" for="wish">Wishes:</label>
    <textarea id="wish" name="wish" rows="4" placeholder="Add your wish to the couple..." required></textarea>

    <button type="submit">Submit Wish</button>
</form>
        <!-- Close button for the popup -->
        <button id="closePopupBtn" style="margin-top: 10px;">Close</button>
    </div>
</div>


                    
                    <?php
                    // Display wishes for this wedding card with status 1 (approved)
           
                    $sql_wishes ="SELECT a.name, a.wish FROM Attendance AS a INNER JOIN wedding_cards AS wc ON a.card_id = wc.id WHERE wc.id = $id LIMIT 3";
                       // Execute the query
    $result_wishes = $conn->query($sql_wishes);

    // Execute the query
    $result_wishes = $conn->query($sql_wishes);

    // Check if there are any results
    if ($result_wishes === false) {
        // Query execution failed
        echo "Error: " . $conn->error;
    } elseif ($result_wishes->num_rows > 0) {
        // Display wishes
        echo "<div class='wishes'>";
        echo "<h2> Wishes</h2>";
        
        // Loop through results and display each wish and name
        while ($row_wish = $result_wishes->fetch_assoc()) {
            echo "<div class='wish'>";
            // Display the name and wish inside the paragraph tags
            echo "<p class='title-style-8'><strong>" . $row_wish['name'] . ":</strong> " . $row_wish['wish'] . "</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        // No approved wishes found
        echo "<p>No approved wishes yet.</p>";
    }
?>
                    <i class="bi bi-heart-fill" style="color: red; font-size: 30px;"></i>
                    <!--<p class="title-style-8" style="opacity: 0; transform: translateY(50px); animation: fadeInUp 2.5s ease forwards;">malmi akka</p>-->
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

        
          
        
        <div id="closing" class="section">
            <div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">
                <div class="d-flex flex-column welcome-content"  style="background-image: url('<?php echo $row['closing_bg']; ?>');">  
                <!--style="background-image: url('./images/bg.png');">-->
                   
                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center shadow-lg m-3 p-3"
                        style="z-index: 99; border-radius: 10px; filter: drop-shadow(0px 3px 3.5px rgba(0,0,0,0.42));">
                        <div class="d-flex flex-column justify-content-end align-items-center text-center mb-5">
                            <p class="title-style-8" style="width: 100%; opacity: 0; transform: translateY(50px); animation: slideInFromBottom 2.5s ease forwards;font-family:TenorSans-Regula !important;">The joy of our wedding will be incomplete without your <br> presence as  you have been a remarkable person in our life journey. <br> Looking forward to seeing you on the wedding day to witness <br> our special moment.
Let’s create more beautiful memories together that would last a life time.</p>
                            <!--<p class="title-style-8 my-3" style="width: 100%; opacity: 0; transform: translateY(50px); animation: slideInFromBottom 2.8s ease forwards;">We are blessed,</p>-->
                             <h2 class="title-style-6" style="width: 100%; opacity: 0; transform: translateY(50px); animation: slideInFromBottom 3.1s ease forwards;"><?php echo $row['bride_name'] . " & " . $row['groom_name']; ?></h2>
                            <img src="<?php echo htmlspecialchars($row['cover_closing']); ?>" alt="" class="welcomeCoupleImage" style="width:165px; height:165px; margin-top:50px;">
                    
                            <p class="title-style-8" style="margin-top:120px; line-height: 0.1px; opacity: 0; transform: translateY(50px); animation: fadeInUp 3.0s ease forwards;">Digital Invitation By</p>
                            <p class="title-style-8" style="line-height: 0.1px; opacity: 0; transform: translateY(50px); animation: fadeInUp 3.0s ease forwards;" > Udul Uthsara </p>
                            <p class="title-style-8" style="line-height: 0.1px; opacity: 0; transform: translateY(50px); animation: fadeInUp 3.0s ease forwards;">+94 77 312 0165 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php
} else {
    echo "Wedding card not found.";
}

        $conn->close();
        ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>



    
    
 <script>
    function showNavigation() {
        document.getElementById("navigation").style.display = "flex";
        document.getElementById("heroSection").style.display = "none";
        document.getElementById("audiobtn").style.display = "flex";
        document.getElementById("cover").classList.add("active");
    }

    document.addEventListener("DOMContentLoaded", function () {
        const navbarBottomLinks = document.querySelectorAll(".navbarBottom a");
        const sections = document.querySelectorAll(".section");
        let touchstartY = 0;
        let touchendY = 0;

        // Hide navigation and other sections
        document.getElementById("navigation").style.display = "none";
        sections.forEach(section => {
            section.classList.remove("active");
        });

        // Show heroSection
        document.getElementById("heroSection").style.display = "flex";

        navbarBottomLinks.forEach(link => {
            link.addEventListener("click", function (event) {
                event.preventDefault();
                const targetId = this.getAttribute("data-target");

                // Hide all sections
                sections.forEach(section => {
                    section.classList.remove("active");
                });

                // Show the selected section
                document.getElementById(targetId).classList.add("active");

                // Update activeBtn class
                navbarBottomLinks.forEach(navLink => {
                    navLink.parentNode.classList.remove("activeBtn");
                });
                this.parentNode.classList.add("activeBtn");
            });
        });

        // Event listener to "Open invitation" button
        document.querySelector("button").addEventListener("click", showNavigation);

        // Touch event listeners for swipe navigation
        document.addEventListener('touchstart', function(event) {
            touchstartY = event.changedTouches[0].screenY;
        }, false);

        document.addEventListener('touchend', function(event) {
            touchendY = event.changedTouches[0].screenY;
            handleGesture();
        }, false);

        function handleGesture() {
            console.log("Touch start Y:", touchstartY);
            console.log("Touch end Y:", touchendY);

            const deltaY = touchendY - touchstartY;

            if (deltaY < 50) { // Swipe up threshold
                // Swiped up
                console.log("Swiped up");
                navigateToNextSection();
            }

            if (deltaY > 50) { // Swipe down threshold
                // Swiped down
                console.log("Swiped down");
                navigateToPreviousSection();
            }
        }

        function navigateToNextSection() {
            // Find the current active section
            const currentSection = document.querySelector(".section.active");
            const currentSectionIndex = Array.from(sections).indexOf(currentSection);

            // If the current section is not the last one and scrolled above 75%, navigate to the next section
            if (currentSectionIndex < sections.length - 1 && window.scrollY >= currentSection.offsetTop + currentSection.offsetHeight * 0.22) {
                currentSection.classList.remove("active");
                sections[currentSectionIndex + 1].classList.add("active");
                updateActiveMenu(currentSectionIndex + 1);
            }
        }



        function navigateToPreviousSection() {
            // Find the current active section
            const currentSection = document.querySelector(".section.active");
            const currentSectionIndex = Array.from(sections).indexOf(currentSection);

            // If the current section is not the first one and scrolled below 75%, navigate to the previous section
            if (currentSectionIndex > 0 && window.scrollY <= currentSection.offsetTop + currentSection.offsetHeight * 0.55) {
                currentSection.classList.remove("active");
                sections[currentSectionIndex - 1].classList.add("active");
                updateActiveMenu(currentSectionIndex - 1);
            }
        }

        function updateActiveMenu(index) {
            // Update activeBtn class in the navbarBottomLinks
            navbarBottomLinks.forEach(navLink => {
                navLink.parentNode.classList.remove("activeBtn");
            });
            navbarBottomLinks[index].parentNode.classList.add("activeBtn");
        }
    });
</script>

<script>
function activateSection() {
    
    const first = document.getElementById('1st');
    const second = document.getElementById('2nd');
    
    console.log("swipe");
    const coupleButton = document.querySelector('.nav-link');
    coupleButton.classList.add('active');
    
    
    const targetElement = document.getElementById('couple');
    if (targetElement) {
        targetElement.classList.add("active");
    }
   first.classList.remove("activeBtn");
   second.classList.add("activeBtn");
}
</script>

    
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const navigation = document.getElementById('navigation');

            window.addEventListener('scroll', function () {
                if (window.scrollY > 0) {
                    navigation.style.transform = 'translateY(0)';
                } else {
                    navigation.style.transform = 'translateY(100%)';
                }
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.section');
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            // Deactivate all sections
            sections.forEach(function(section) {
                section.classList.remove('active');
            });

            // Activate target section
            targetSection.classList.add('active', 'slide-in');
        });
    });
});

</script>
 <script>
// Get reference to the audio element
const audio = document.getElementById('myAudio');

// Function to play the audio
function playAudio() {
    audio.play().catch(function(error) {
        console.error("Autoplay was prevented:", error);
        // Autoplay was prevented, handle the error
        // You can still play the audio in response to user interaction
    });
}

// Trigger the audio playback when the page is clicked anywhere
document.addEventListener('click', function() {
    playAudio();
}, { once: true }); // { once: true } ensures that the event listener is triggered only once

// To handle the case where the audio ends and to play it again
audio.addEventListener('ended', function() {
    audio.currentTime = 0; // Reset audio to the beginning
    audio.play(); // Play again
});

 </script>
 
 
 <script>
     document.getElementById('showWishFormBtn').addEventListener('click', function() {
    // Show the form
    document.getElementById('wishForm').style.display = 'block';
    
    // Fill in the hidden input field with the value from the button's data attribute
    document.getElementById('card_id').value = this.getAttribute('data-card-id');
});

 </script>



<script>
    // const container = document.getElementById('navigation');
    // const leftArrow = document.querySelector('.left-arrow');
    // const rightArrow = document.querySelector('.right-arrow');

    // container.addEventListener('scroll', function() {
        
    //     leftArrow.style.display = container.scrollLeft > 0 ? 'block' : 'none';
    //     rightArrow.style.display = container.scrollLeft < container.scrollWidth - container.clientWidth ? 'block' : 'none';
    // });

    // function scrollMenu(direction) {
    //     const scrollAmount = 1000; 
    //     if (direction === 'left') {
    //         container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
    //         leftArrow.style.display = 'block'; 
    //         rightArrow.style.display = 'block';
    //     } else {
    //         container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    //         rightArrow.style.display = 'none'; 
    //         leftArrow.style.display = 'block'; 
    //          leftArrow.style.left = '70px'; 
    //     }
    // }
    
       const container = document.getElementById('navigation');
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');

    container.addEventListener('scroll', function() {
        
        leftArrow.style.display = container.scrollLeft > 0 ? 'block' : 'none';
        rightArrow.style.display = container.scrollLeft < container.scrollWidth - container.clientWidth ? 'none' : 'block';
    });

    function scrollMenu(direction) {
        const scrollAmount = 1000; 
        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            leftArrow.style.display = 'block'; 
            rightArrow.style.display = 'block';
            console.log("Move to left")
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            rightArrow.style.display = 'none'; 
            leftArrow.style.display = 'block'; 
             leftArrow.style.left = '70px'; 
             console.log("Move to right")
        }
    }
</script>

<script>
    // Get the button and the popup container
    const showWishFormBtn = document.getElementById('showWishFormBtn');
    const popupContainer = document.getElementById('popupContainer');

    // Add click event listener to the button
    showWishFormBtn.addEventListener('click', function() {
        // Show the popup
        popupContainer.style.display = 'flex';
    });

    // Get the close button
    const closePopupBtn = document.getElementById('closePopupBtn');

    // Add click event listener to the close button
    closePopupBtn.addEventListener('click', function() {
        // Hide the popup
        popupContainer.style.display = 'none';
    });
</script>




</body>

</html>