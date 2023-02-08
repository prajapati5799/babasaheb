<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- #content -->

    <footer class="footer-wrapper">
        <div class="container-wrapper">
            <div class="row-grid">
                <div class="col-12">
                    <div class="copyright-text text-center">
                        <p>
                            <?php echo get_field('copyright_contnet','options');?>
                            <?php $social_media_list = get_field('footer_pages','options'); ?>
                            <?php 
                                $cnt = 0;
                                foreach ($social_media_list as $sml => $svalue) 
                                {  
                                    if($cnt == 0 ) 
                                        $col = '|';
                                    else 
                                        $col = '';
                                        ?>
                                    <a href="<?php echo $svalue['page_link']; ?>">
                                        <?php echo $svalue['page_name']; ?>
                                    </a> <?php echo $col; ?>
                                    <?php
                                $cnt++;
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	<!--</div> #page -->

<?php wp_footer(); ?>

</body>
</html>
