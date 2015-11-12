<div id="video-wrap" <?php echo isset($_GET['tab']) || 2 == $_GET['tab'] ? ' style="display: none;" ' : ''  ?>>
    <div class="homepage-hero-module">
        <div class="video-container">
            <div class="filter"></div>
            <video autoplay loop class="fillWidth">
                <source src="<?php echo get_template_directory_uri() ?>/video/meetingroom/MP4/Meeting-Room.mp4" type="video/mp4" />Your browser does not support the video tag. I suggest you upgrade your browser.
                <source src="<?php echo get_template_directory_uri() ?>/video/meetingroom/WEBM/Meeting-Room.webm" type="video/webm" />Your browser does not support the video tag. I suggest you upgrade your browser.
            </video>
            <div class="poster hidden">
                <img src="<?php echo get_template_directory_uri() ?>/video/meetingroom/Snapshots/Meeting-Room.jpg" alt="">
            </div>
        </div>
    </div>
</div>
