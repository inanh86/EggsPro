<?php defined('ABSPATH') || exit;

/**
 * Header
 */
add_action( NAME_SPACE . 'header', function() {?>
    <header id="header" class="mainHead">
        <?php do_action(NAME_SPACE.'nav_before');?>
    </header>
<?php }, 1 );

/**
 * Footer
 */
add_action( NAME_SPACE.'footer', function(){?>
    <footer id="footer" class="mainFooter">
        <?php do_action(NAME_SPACE.'footer_content');?>
    </footer>
<?php }, 10);