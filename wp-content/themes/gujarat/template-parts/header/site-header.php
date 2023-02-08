<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= ( true === get_theme_mod( 'display_title_and_tagline', true ) ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>

 <header class="header-wrapper">
        <nav class="navbar">
            <div class="container-wrapper">
                <div class="navigation-bar">
                    <div class="left-side">
                        <div class="site-logo">
                            <a href="<?php echo home_url();?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="site-logo" />
                            </a>
                        </div>
                        <div class="right-side">                        
                            <button class="navbar-toggler" type="button">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                        <div class="navbar-nav-items">
                            <?php 
                                wp_nav_menu(
                                    array(
                                        'theme_location'  => 'primary',
                                        'menu_class'      => 'menu-wrapper',
                                        'container_class' => 'primary-menu-container',
                                        'items_wrap'      => '<ul id="primary-menu-list" class="%2$s navigation-list">%3$s</ul>',
                                        'fallback_cb'     => false,
                                    )
                                );
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
