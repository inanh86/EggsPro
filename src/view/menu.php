<?php 
if( !defined('ABSPATH') ) {
    exit;
}

/**
 * thanh menu
 */
add_action(NAME_SPACE.'nav_before', function() { ?>
    <div class="header_topbar dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-4"><?php nav_before_left();?></div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-8"><?php nav_before_right();?></div>
            </div>
        </div>
    </div>
    <div class="general_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-2 col-sm-3 col-4"><?php eggspro_menu_logo();?></div>
                <div class="col-lg-7 col-md-7 col-sm-4 col-3">
                    <?php wp_nav_menu([
                        'container' => 'div',
                        'container_class' => 'navigation navigation-landscape',
                    ]);?>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-5 col-5"><?php eggspro_menu_right();?></div>
            </div>
        </div>
    </div>
<?php } );

/**
 * Menu Lang
 */
function nav_before_left() { ?>
    <ul class="tp-list nbr ml-2">
        <li class="dropdown dropdown-currency hidden-xs hidden-sm show">
            <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Eng<i class="bi bi-arrow-down-short"></i></a>
        </li>
    </ul>
<?php }

function nav_before_right() { ?>
    <div class="topbar_menu">
        <ul>
            <li>
                <a href="#"><i class="bi bi-bag"></i><?php __lang('Tải khoan');?></a>
            </li>
            <li>
                <a href="#"><i class="bi bi-geo-alt"></i><?php __lang('Kiểm tra đơn hàng');?></a>
            </li>
        </ul>
    </div>
<?php }

/**
 * Left Menu Logo
 */
function eggspro_menu_logo() { ?>
    <a class="nav-brand" href="<?php echo home_url('/');?>" title="<?php __lang('trang chủ');?>">
        <img src="https://themezhub.net/odex-live/odex/assets/img/grocery-logo.png" class="logo" alt="<?php echo get_bloginfo( 'name');?>">
    </a>
<?php }

/**
 * Right menu Nav
 */
function eggspro_menu_right() { ?>

<?php }