<?php defined('ABSPATH') || exit;

/**
 * Side banner for home
 */
add_action( NAME_SPACE.'index', function() { ?>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <?php carousel();?>
            </div>
        </div>
    </div>
<?php }, 1);

/**
 * Section Index
 */
add_action(NAME_SPACE.'index', function() {

}, 2);