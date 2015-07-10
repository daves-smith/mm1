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

<body <?php body_class($layout); ?> >
	<header>
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
	</header>

