<?php
/**
 * Template Name: Home
 */
get_header('home'); ?>

<!--Wrapper Start Here-->
<div id="homepage" class="homepage">
<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
<?php $img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
						$img_src = $img[0]; ?>
<section id="wrapper" style="background:url(<?php echo $img_src; ?>) repeat top center #353535;background-size: cover;">
  <div class="frame">
    <div class="communicate">
      <div class="search-label">Who do you want to communicate better with?</div>
	
		<form id="searchform" action="<?php echo home_url(); ?>/" method="get" role="search">
					<input type="hidden" value="course" name="post_type">
					<input type="text" id="texttype" placeholder="eg., My Boss, My Employees, My Children, My Customers" id="s" name="s" value="" class="searchBox" style="font-weight: bold;">
					<input type="submit" class="sub_but" value="learn">
		</form>
    		<div class="search-tips">
                Online communication courses in Public Speaking, Leadership, Dating and everything in between. Learn at your own leisure.            </div>
  	 </div>
</section>
<section id="feature-courses">
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
