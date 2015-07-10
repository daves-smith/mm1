<?php
//Header File
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title>
<?php echo wp_title('|',true,'right'); ?>
</title>
<?php

$layout = vibe_get_option('layout');
if(!isset($layout) || !$layout)
    $layout = '';

wp_head();
?>
</head>

<body <?php body_class($layout); $fix=vibe_get_option('header_fix'); ?> >
	<header class="lightbg" id="<?php if(isset($fix) && $fix){echo 'fix';} ?>">
		<div class="row">
		<div class="col-md-4 toppadding">
	
		</div>
		<div class="col-md-4 logo">
			 <a href="<?php echo vibe_site_url(); ?>"><img src="<?php  echo apply_filters('wplms_logo_url',VIBE_URL.'/images/logo.png'); ?>" alt="<?php echo get_bloginfo('name'); ?>" /></a>
			 <div class="logo_tagline"><?php echo get_bloginfo ( 'description' ); ?></div>
		</div>
		<div class="col-md-4 toppadding">
			 <?php
                            if ( function_exists('bp_loggedin_user_link') && is_user_logged_in() ) :
                                ?>
                                <ul class="topmenu">
									<li><a href="<?php echo home_url(); ?>/become-a-instructor">Become an Instructor</a></li>
                                    <li><a href="<?php bp_loggedin_user_link(); ?>" class="smallimg vbplogin"><?php $n=vbp_current_user_notification_count(); echo ((isset($n) && $n)?'<em></em>':''); bp_loggedin_user_avatar( 'type=full' ); ?><span><?php bp_loggedin_user_fullname(); ?></span></a></li>
                                   <div id="vibe_bp_login" style="display:none;">
										<?php
										if ( function_exists('bp_get_signup_allowed')){
											the_widget('vibe_bp_login',array(),array());   
										}
									?>
									</div> 
                                    
                                </ul>
                            <?php
                            else :
                                ?>
                                <ul class="topmenu">
									<li><a href="<?php echo home_url(); ?>/become-a-instructor">Become an Instructor</a></li>
                                    <li><a href="#login_box" class="smallimg fancybox "><span><?php _e('log in | sign up','vibe'); ?></span></a></li>
                                	
                                </ul>
                            <?php
                            endif;
                        ?>
						<div id="vibe_bp_login" style="display:none;">
						    <?php
						    if ( function_exists('bp_get_signup_allowed')){
						        the_widget('vibe_bp_login',array(),array());   
						    }
						?>
						</div> 
                        <div id="login_box" style="display:none;">
						<h2>Login to your Emiisor account</h2>
						<?php do_action( 'wordpress_social_login' ); ?> 
                        <?php
                            if ( function_exists('bp_get_signup_allowed')){
                                the_widget('vibe_bp_login',array(),array());   
                            }
                        ?>
                       </div> 
						 <div id="signup_box" style="display:none;">
							<?php echo do_shortcode('[wppb-register]'); ?>
							<?php do_action( 'wordpress_social_login' ); ?> 
                       </div> 
		</div>
		</div>
<div class="row">
					<div class="col-md-3">
						 <div class="toggle-dropdown <?php if(is_page('courses')) { echo 'active'; } else { echo 'toggle-up'; } ?>">
								<div class="toggler"><i class="icon-content-43"></i> Main Categories</div>
								<?php echo get_course_categories(); ?>
						 </div>
					
					</div>
					<div class="col-md-6 search-label">
								<label class="screen-reader-text" for="s">Who do you want to communicate better with ?</label>
					</div>
					<div class="col-md-3 search-blk">
					 <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
           		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Hit enter to search...','vibe'); ?>" /><input type="submit" id="innersearch" value="Learn" />
							 <?php $course_search=vibe_get_option('course_search');
                     if(isset($course_search) && $course_search)
                     echo '<input type="hidden" value="course" name="post_type" />';
               ?>
          	</form>
					</div>
				</div>
      </div>
	</header>

