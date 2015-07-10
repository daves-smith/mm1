<?php
/**
 * Template Name: Become an Instructor
 */
get_header('instructor'); ?>
<div id="becomepage" class="homepage">
<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
<?php $img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
$img_src = $img[0]; ?>
<section id="wrapper" style="background:url(<?php echo $img_src; ?>) repeat top center #353535;background-size: cover;">
<div class="container">
<div class="main-blk">
<div class="left_column">
<h3>Create Course</h3>
<h3>Become a Direct Coach</h3>
<h3>Emiisor Ennovate</h3>
</div>
<div class="right_column">
<h2>Instructor Sign Up</h2>
<a href="#pop_form" class=" button fancybox">Click Here</a>
<?php echo $msg; ?>
<div id="pop_form" style="display:none;">
<?php if(is_user_logged_in()) { ?>
<?php echo do_shortcode('[ninja_forms id=5]'); ?><?php } else { ?>
<h2>Become an Instructor</h2>
<?php echo do_shortcode('[new_custom_registration]');  ?>
<?php } ?></div>
</div>
</div>
</div>
</section> 
<section class="innercontent" style="top:100%;position:absolute;width:100%;">
<div class="container">
			<?php the_content(); ?>
		</div>
		<footer>
			<div id="footerbottom">
				<div class="container">
					<div class="row">
						 <div class="col-md-12"> 
							 <div id="footermenu">
						                <?php
						                        $args = array(
						                            'theme_location'  => 'footer-menu',
						                            'container'       => '',
						                            'menu_class'      => 'footermenu',
						                            'fallback_cb'     => 'vibe_set_menu',
						                        );
						                        wp_nav_menu( $args );
						                ?>
						      </div> 
						</div>
					</div>
				</div>
			</div>
	</footer>
</section>

<?php endwhile; endif; ?>
</div>
<?php get_footer('home'); ?>
