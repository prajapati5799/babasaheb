<?php
/**
 * Template Name: Blog Page
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
get_header(); 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$loop = new WP_Query( array( 'post_type' => 'post',
        'posts_per_page' => 5,
        'paged'          => $paged )
);
if ( $loop->have_posts() ):
?>
    <div class="main-content-wrapper">
        <div class="blog-section">
            <div class="container-wrapper">
                <div class="row-grid">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <div class="col-6">
                        <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
                        <div class="newsBox">
                            <?php if(isset($url) && !empty($url)) { ?>
                                <div class="news-img">
                                    <a href="<?php echo get_permalink(); ?>">
                                        <img src="<?php echo $url ?>" alt="<?php echo $post->post_title; ?>" >
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="news-info">
                                <h2><a href="<?php echo get_permalink(); ?>"><?php echo $post->post_title; ?></a></h2>
                                <?php echo $post->post_content; ?>
                            </div>
                        </div>
                        </div>
                        <?php endwhile; ?>
                </div>
                <!-- <div class="more-btn"><a href="#" class="btn">Load More</a></div> -->
                <nav class="pagination">
                    <?php pagination_bar( $loop ); ?>
                </nav>
            </div>
        </div>

    </div>
    
    <?php wp_reset_postdata();
    endif;?>
<?php get_footer(); ?>
