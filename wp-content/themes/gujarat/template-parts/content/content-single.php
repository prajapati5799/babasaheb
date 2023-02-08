<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<div class="blog-section">
    <div class="container-wrapper">
        <div class="newsBlock">
            <div class="news-img">
                <?php twenty_twenty_one_post_thumbnail(); ?>
            </div>
            <div class="news-info">
                <h2><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h2>
                <?php the_content(); ?>
            </div>
        </div>
        <?php 
        $twentytwentyone_next = is_rtl() ? twenty_twenty_one_get_icon_svg( 'ui', 'arrow_left' ) : twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right' );
        $twentytwentyone_prev = is_rtl() ? twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right' ) : twenty_twenty_one_get_icon_svg( 'ui', 'arrow_left' );

        $twentytwentyone_next_label     = esc_html__( 'Next post', 'twentytwentyone' );
        $twentytwentyone_previous_label = esc_html__( 'Previous post', 'twentytwentyone' );

        the_post_navigation(
            array(
                'next_text' => '<p class="meta-nav">' . $twentytwentyone_next_label . $twentytwentyone_next . '</p>',
                'prev_text' => '<p class="meta-nav">' . $twentytwentyone_prev . $twentytwentyone_previous_label . '</p>',
            )
        );
        ?>
    </div>
</div>
