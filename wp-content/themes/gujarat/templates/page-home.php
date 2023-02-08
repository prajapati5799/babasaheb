<?php
/**
 * Template Name: Home Page
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
                <div class="info-content">
                    <?php 
                        $top_description = get_field( "top_description" );
                        if( $top_description ) {
                            echo $top_description;
                        } else {
                            echo 'Content Not Found';
                        }
                    $two_column_content = get_field( "two_column_content" );
                    ?>
                    <div class="media-section">
                        <?php foreach ($two_column_content as $key => $value) { ?>
                            <div class="media-row">
                                <div class="media-image">
                                    <img src="<?php echo $value['image']; ?>" alt="">
                                </div>
                                <div class="media-text">
                                    <?php echo $value['content']; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                     <?php 
                        $bottom_description = get_field( "bottom_description" );
                        if( $bottom_description ) {
                            echo $bottom_description;
                        } else {
                            echo 'Content Not Found';
                        }
                    ?>
                </div>
            </div>
        </section>
    </div>
<?php get_footer(); ?>
