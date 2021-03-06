<?php


  if(is_user_logged_in()):

    global $post;

    $user_id = get_current_user_id();

    $answers=get_comments(array(
      'post_id' => $post->ID,
      'status' => 'approve',
      'number'=>1,
      'user_id' => $user_id
      ));
    if(isset($answers) && is_array($answers) && count($answers)){
        $answer = end($answers);
        $content = $answer->comment_content;
    }else{
        $content='';
    }
 
    $fields =  array(
        'author' => '<p><label class="comment-form-author clearfix">'.__( 'Name','vibe' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input class="form_field" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" /></p>',
        'email'  => '<p><label class="comment-form-email clearfix">'.__( 'Email','vibe' ) .  ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .          '<input id="email" class="form_field" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"/></p>',
        'url'   => '<p><label class="comment-form-url clearfix">'. __( 'Website','vibe' ) . '</label>' . '<input id="url" name="url" type="text" class="form_field" value="' . esc_attr( $commenter['comment_author_url'] ) . '"/></p>',
         );
        
    $comment_field='<p>' . '<textarea id="comment" name="comment" class="form_field" rows="15" ">'.((isset($content) && $content)?$content:__('Additional Notes','vibe')).'</textarea></p>';
    
    
    comment_form(array('fields'=>$fields,'comment_field'=>$comment_field,'label_submit' => __('Upload Assignment','vibe'),'title_reply'=> '<h3 class="heading">'.__('Upload Assignment','vibe').'</h3>','logged_in_as'=>'','comment_notes_after'=>'' ));
    
  endif;
  ?>