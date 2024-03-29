<?php
function renderImage($postId)
{
    $imageList = queryFile($postId, "image");
    if ($imageList != []) {
?>
        <div class="slider-wrapper">
            <?php if (sizeof($imageList) > 1) { ?>
                <button class="slide-arrow" id="slide-arrow-prev">
                    <p class="slide-arrow-text">&#8249;</p>
                </button>
                <button class="slide-arrow" id="slide-arrow-next">
                    <p class="slide-arrow-text">&#8250;</p>

                </button>
            <?php } ?>
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

function renderVideo($postId, $singleVideo = false)
{
    $videoList = queryFile($postId, "video");
    if ($videoList == []) {
        return 0;
    }
    foreach ($videoList as  $video) { ?>
        <video controls>
            <source src="<?php echo $video ?>" type="<?php echo mime_content_type($video) ?>">
        </video>
<?php
        if ($singleVideo) {
            break;
        }
    }
    return 1;
}

function queryFile($postId, $type)
{
    $dirName = "postMedia/" . $postId . "/";
    if (!is_dir($dirName)) {
        return [];
    }
    $fileList = array();
    foreach (scandir($dirName) as $file) {
        if (str_starts_with(mime_content_type($dirName . $file), $type)) {
            array_push($fileList, $dirName . $file);
        }
    }
    return $fileList;
}


function mediaRender($postId)
{
    //render only one carousel/video for homepage
    $result = renderVideo($postId, True);
    if (!$result) {
        renderImage($postId);
    }
}
