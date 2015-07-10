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
$show_course_cats = 'no';
if(is_tax( 'course-cat' ) || is_page('')) {
	$sub_term = get_queried_object();
	$sub_term_id = $sub_term->term_id;
	$taxonomy_name = 'course-cat';
	$sub_terms = get_term_children( $sub_term_id, $taxonomy_name );
	if ( !empty( $sub_terms ) && !is_wp_error( $sub_terms ) ){
	 $show_course_cats = 'yes';
	}
}

?>
</head>
<?php $img = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
						$img_src = $img[0]; ?>
<body <?php body_class($layout); ?> >
<div id="innerpages" class="innerpages">
 <?php
            $fix=vibe_get_option('header_fix');
        ?>
        <header class="innerpages <?php if(isset($fix) && $fix){echo 'fix';} ?>">
            <div class="container">
                <div id="searchdiv">
                    <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                        <div><label class="screen-reader-text" for="s">Search for:</label>
                            <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Hit enter to search...','vibe'); ?>" />
                            <?php 
                                $course_search=vibe_get_option('course_search');
                                if(isset($course_search) && $course_search)
                                    echo '<input type="hidden" value="course" name="post_type" />';
                            ?>
                            <input type="submit" id="innersearch" value="Search" />
                        </div>
                    </form>
                </div>
                <div class="row">
					<div class="col-md-3 ">&nbsp;</div>
          <div class="col-md-6 logo">
						<a href="<?php echo vibe_site_url(); ?>"><img src="<?php  echo apply_filters('wplms_logo_url',VIBE_URL.'/images/logo.png'); ?>" alt="<?php echo get_bloginfo('name'); ?>" /></a>
					</div>
          <div class="col-md-3 toppadding">
          <?php  if ( function_exists('bp_loggedin_user_link') && is_user_logged_in() ) : ?>
            <ul class="topmenu">
							<?php $user = wp_get_current_user();
if( in_array( "instructor", (array) $user->roles ) { ?>
    <li><a style="color:#fff;text-decoration:none;" href="<?php echo home_url(); ?>/course-builder">Create Course</a></li>
<?php } else { ?>
							<li><a style="color:#fff;text-decoration:none;" href="<?php echo home_url(); ?>/become-a-instructor">Become an Instructor</a></li> <?php } ?> |
              <li><a href="<?php bp_loggedin_user_link(); ?>" class="smallimg vbplogin"><?php $n=vbp_current_user_notification_count(); echo ((isset($n) && $n)?'<em></em>':''); bp_loggedin_user_avatar( 'type=full' ); ?><span><?php bp_loggedin_user_fullname(); ?></span></a></li>
  					  <div id="vibe_bp_login" style="display:none;">
										<?php
										if ( function_exists('bp_get_signup_allowed')){
											the_widget('vibe_bp_login',array(),array());   
										}
									?>
									</div> 
            </ul>
          <?php else : ?>
           	<ul class="topmenu">
							<li><a style="color:#fff;text-decoration:none;" href="<?php echo home_url(); ?>/become-a-instructor">Become an Instructor</a></li> |
              <li><a href="#login_box" id="dropdown_login" class="smallimg fancybox "><span><?php _e('login | signup','vibe'); ?></span></a></li>
            </ul>
          <?php endif; ?>
            <div id="login_box" style="display:none;">
							<h2>Login to your Emiisor account</h2>
							<?php do_action( 'wordpress_social_login' ); ?> 
              <?php if ( function_exists('bp_get_signup_allowed')){
                    the_widget('vibe_bp_login',array(),array());   
               } ?>
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
		<div id="inner-wrapper" class="<?php if($show_course_cats != 'yes') { echo 'swipe'; if(!is_page('courses')) { echo ' active'; } } ?>">
     <div class="sidebarcontent">   
<?php if($show_course_cats == 'yes') { ?> 
     	<div class="courses-sub-cats">
				<h4><?php echo $sub_term->name; ?></h4>
				<ul>
		<?php foreach ( $sub_terms as $child ) {
				$term = get_term_by( 'id', $child, $taxonomy_name );
	  	 echo '<li><a href="' . get_term_link( $term ) . '">' . $term->name. '</a></li>';
	  } ?>
			</ul>	
			</div>
<?php } ?>
     </div>
     <div class="pusher">
				<div class="body_container <?php echo get_the_slug(get_the_ID()); ?>">
