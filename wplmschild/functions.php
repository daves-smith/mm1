<?php

if ( !defined( 'VIBE_URL' ) )
define('VIBE_URL',get_template_directory_uri());

add_action('wp_enqueue_scripts', 'vibe_wplms_child_js');
function vibe_wplms_child_js(){
	wp_enqueue_script( 'child-custom-js', get_stylesheet_directory_uri().'/custom.js',array('jquery'));	
	wp_enqueue_script( 'fancybox-js', get_stylesheet_directory_uri().'/js/jquery.fancybox.pack.js',array('jquery'));
	wp_enqueue_style( 'fancybox-css', get_stylesheet_directory_uri() . '/css/jquery.fancybox.css', array(), '', 'all' );	
}


function get_course_categories($parent=0){
	$output = '';
	$args = array('hide_empty'=> 0, 'parent' => $parent);
	$terms = get_terms( 'course-cat',$args );
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		$output.= '<ul>';
    foreach ( $terms as $term ) {
			$sub = '';
	  	$output.= '<li><a href="' . get_term_link( $term ) . '">' . $term->name;
			$sub = get_course_categories($term->term_id);
			if(!empty($sub)) {
				$output.=	'<i class="icon-arrow-1-right"></i>';
			}
			$output.= '</a>';
			if(!empty($sub)) {
				$output.= '<div class="dropdown_menu_sub">';
				$output.= $sub;
				$output.='</div>';
			}

			$output.='</li>';
	  }
		$output.= '</ul>';
	}
	return $output;
}

function appthemes_check_user_role( $role, $user_id = null ) {
 
    if ( is_numeric( $user_id ) )
	$user = get_userdata( $user_id );
    else
        $user = wp_get_current_user();
 
    if ( empty( $user ) )
	return false;
 
    return in_array( $role, (array) $user->roles );
}

if ( appthemes_check_user_role( 'administrator' )) { 
    
}
else { 
	add_filter('show_admin_bar', '__return_false'); 
}

function registration_form( $username, $password, $email, $first_name, $last_name, $bio ) {
    echo '
    <style>
    div {
        margin-bottom:2px;
    }
     
    input{
        margin-bottom:4px;
    }
    </style>
    ';
 
    echo '
    <form class="reg_form" action="' . $_SERVER['REQUEST_URI'] . '" method="post">
    <div>
    <label for="username">Username <strong>*</strong></label>
    <input type="text" name="username" value="' . ( isset( $_POST['username'] ) ? $username : null ) . '">
    </div>
     
    <div>
    <label for="password">Password <strong>*</strong></label>
    <input type="password" name="password" value="' . ( isset( $_POST['password'] ) ? $password : null ) . '">
    </div>
     
    <div>
    <label for="email">Email <strong>*</strong></label>
    <input type="text" name="email" value="' . ( isset( $_POST['email']) ? $email : null ) . '">
    </div>
     
    <div>
    <label for="firstname">First Name</label>
    <input type="text" name="fname" value="' . ( isset( $_POST['fname']) ? $first_name : null ) . '">
    </div>
     
    <div>
    <label for="website">Last Name</label>
    <input type="text" name="lname" value="' . ( isset( $_POST['lname']) ? $last_name : null ) . '">
    </div>

    
    <div>
    <label for="bio">About / Bio</label>
    <textarea name="bio">' . ( isset( $_POST['bio']) ? $bio : null ) . '</textarea>
    </div>
    <input type="submit" name="submit" class="button" value="Register"/>
    </form>';
} 

function registration_validation( $username, $password, $email, $first_name, $last_name, $bio )  { 
global $reg_errors;
$reg_errors = new WP_Error;
if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
    $reg_errors->add('field', 'Required form field is missing');
}		
if ( 4 > strlen( $username ) ) {
    $reg_errors->add( 'username_length', 'Username too short. At least 4 characters is required' );
}
if ( username_exists( $username ) ) {
    $reg_errors->add('user_name', 'Sorry, that username already exists!');
}
if ( ! validate_username( $username ) ) {
    $reg_errors->add( 'username_invalid', 'Sorry, the username you entered is not valid' );
}
if ( 5 > strlen( $password ) ) {
        $reg_errors->add( 'password', 'Password length must be greater than 5' );
    }
if ( !is_email( $email ) ) {
    $reg_errors->add( 'email_invalid', 'Email is not valid' );
}
if ( email_exists( $email ) ) {
    $reg_errors->add( 'email', 'Email Already in use' );
}
if ( is_wp_error( $reg_errors ) ) {
     foreach ( $reg_errors->get_error_messages() as $error ) {
     
        echo '<div>';
        echo '<strong>ERROR</strong>:';
        echo $error . '<br/>';
        echo '</div>';
         
    }
}
}

function complete_registration() {
    global $msg,$reg_errors, $username, $password, $email,$first_name, $last_name, $bio;
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $username,
        'user_email'    =>   $email,
        'user_pass'     =>   $password,
        'first_name'    =>   $first_name,
        'last_name'     =>   $last_name,
        'description'   =>   $bio,
		'role'          =>   'instructor'
        );
        $user = wp_insert_user( $userdata );
        $msg = 'Registration complete. Check your mail for login details.'; 
		$subject = 'Instructor Registration Completed Successfully';
		$message = 'Welcome to Emiisor <br> <table><tr> <td> Username : </td><td>'.$username.'</td></tr><tr><td>Password : </td><td>'.$password.'</td></tr><tr><td>Registration Complete</td><td>Goto <a href="' . get_site_url() . '">login page</a>.</td></tr></table>';   
		wp_mail($email,$subject,$message);
		wp_redirect(site_url('/thank-you'));
    }
}

function custom_registration_function() {
    if ( isset($_POST['submit'] ) ) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['bio']
        );
         

        global $username, $password, $email,$first_name, $last_name,$bio;
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );
        $first_name =   sanitize_text_field( $_POST['fname'] );
        $last_name  =   sanitize_text_field( $_POST['lname'] );
        $bio        =   esc_textarea( $_POST['bio'] );
 

        complete_registration(
		    $username,
		    $password,
		    $email,
		    $first_name,
		    $last_name,
		    $bio
		    );
    }
 
 	   registration_form(
		    $username,
		    $password,
		    $email,
		    $first_name,
		    $last_name,
		    $bio
		    );
}

add_shortcode( 'new_custom_registration', 'custom_registration_shortcode' );

function custom_registration_shortcode() {
    ob_start();
    custom_registration_function();
    return ob_get_clean();
}
function get_the_slug( $id=null ){
  if( empty($id) ):
    global $post;
    if( empty($post) )
      return ''; // No global $post var available.
    $id = $post->ID;
  endif;

  $slug = basename( get_permalink($id) );
  return $slug;
}
function my_files_only( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) !== false ) {
        if ( !current_user_can( 'level_5' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}

add_filter('parse_query', 'my_files_only' );
?>
