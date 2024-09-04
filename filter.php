<?php
    // Include header
    require_once 'card_header.php';
?>

<div class="card-area p-0 m-0 position-relative justify-content-center align-items-center">
        <div class="d-flex flex-column welcome-content" style="background-image: url('./images/bg.png');">
            <!-- <div class="overlay"></div> -->
            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center shadow-lg m-3 p-3"
                style="z-index: 99; border-radius: 10px; filter: drop-shadow(0px 3px 3.5px rgba(0,0,0,0.42));">
                <!-- <img src="./images/Blue & Yellow Minimal Travel Agency Free Logo.svg" alt=""> -->


                <div class="d-flex flex-column mb-5">
                    <h2 class="title-style-6">Wedding Filter</h2>
                    <p class="title-style-8">Share the special moment of the day by using <br>
                        our instargram wedding filter below</p>
                    <button class="mapButton"><i class="bi bi-instagram"></i> Open filter</button>
                </div>

            </div>
            <?php
    require_once 'cardNav.php';
?>
        </div>
    </div>
 
<?php
    // Include header
    require_once 'card_footer.php';
?>