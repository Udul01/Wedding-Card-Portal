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
                    <h2 class="title-style-6">Map</h2>
                    <h3 class="title-style-7">The Epitome</h3>
                    <p class="title-style-8">57 Kurunegala - Dambulla Rd <br> Badagamuwa 6000</p>

                    <iframe class="mapIframe mb-3" width="300" height="300" frameborder="0" scrolling="no"
                        marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a
                            href="https://www.gps.ie/">gps trackers</a></iframe>

                    <button class="mapButton"><i class="bi bi-map"></i> Open map</button>
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