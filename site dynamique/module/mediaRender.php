<?php
function renderImage($postId)
{
    $dirName = "postMedia/" . $postId . "/";
    if (!is_dir($dirName)) {
        return 0;
    }
    $imageList = array();
    foreach (scandir($dirName) as $file) {
        if (str_starts_with(mime_content_type($dirName . $file), "image")) {
            array_push($imageList, $dirName . $file);
        }
    }
    if ($imageList != []) {
?>
        <div class="slider-wrapper">
            <button class="slide-arrow" id="slide-arrow-prev">
                <p class="slide-arrow-text">&#8249;</p>
            </button>
            <button class="slide-arrow" id="slide-arrow-next">
                <p class="slide-arrow-text">&#8250;</p>

            </button>
            <ul class="slides-container" id="slides-container">
                <?php foreach ($imageList as $file) {
                    echo '<li class="slide"><img src="' . $file . '"></img></li>';
                } ?>

            </ul>
        </div>
        <script>
            const slidesContainer = document.getElementById("slides-container");
            const slide = document.querySelector(".slide");
            const prevButton = document.getElementById("slide-arrow-prev");
            const nextButton = document.getElementById("slide-arrow-next");

            nextButton.addEventListener("click", () => {
                const slideWidth = slide.clientWidth;
                slidesContainer.scrollLeft += slideWidth;
            });

            prevButton.addEventListener("click", () => {
                const slideWidth = slide.clientWidth;
                slidesContainer.scrollLeft -= slideWidth;
            });
        </script>

<?php
    }
}

