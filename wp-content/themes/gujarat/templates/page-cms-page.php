<?php
/**
 * Template Name: CMS Page
 * The template for displaying home page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_twenty
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
     <div class="main-content-wrapper" id="content">
        <section class="info-sections">
            <div class="container-wrapper">
                <div class="info-content text-center">
                    <?php echo the_content(); ?>
                </div>
            </div>
        </section>
    </div>
<?php get_footer(); ?>
