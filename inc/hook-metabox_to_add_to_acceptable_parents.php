<?php
/*
* hook-only_show_acceptable_parents.php tells the parent in the attribute area to only allow 
* posts that also have a corrisponding title in services or industries
* the topics and articles now need a checkbox that allow the user to choose if any other post can be allowed to be a parent in these areas
* I don't want to use ACF for this because I don't want any stack issues if I need to call the metadata in other places
*/


// add meta box to topics and articles so the user can choose if 
// the particular post is allowed to be a parent of other posts

// Fire meta box setup function on the post editor screen
add_action( 'load-post.php', 'cwf_check_meta_boxes_setup' );
add_action( 'load-post-new.php', 'cwf_check_meta_boxes_setup' );

// Meta box setup function
function cwf_check_meta_boxes_setup() {
    //Add meta boxes on the 'add_meta_boxes' hook
    add_action( 'add_meta_boxes', 'cwf_add_check_meta_boxes' );
    // Save post meta on the 'save_post' hook
    add_action( 'save_post', 'cwf_save_post_meta_from_box', 10, 2 );
}

// Create meta boxes to be displayed on the post editor screen.
function cwf_add_check_meta_boxes() {
    add_meta_box(
        'cwf-post-class',      // Unique ID
        esc_html__( 'Make this post a parent?', 'cwf' ),    // Title
        'cwf_check_meta_box_class',   // Callback function
        array('solution', 'insights'),         // Admin page (or post type)
        'side',         // Context
        'default'         // Priority
    );
}

// Display the post meta box.
function cwf_check_meta_box_class( $object, $box ) { ?>
  <?php wp_nonce_field( basename( __FILE__ ), 'cwf_allow_parent_nonce' ); ?>
  <p>
    <label for="cwf-post-class"><?php _e( "Allow this post to be a parent", 'cwf' ); ?></label>
    <br />
    <?php 
        $field_id_value = get_post_meta( $object->ID, 'allowed_to_parent', true ); 
        if($field_id_value == "true"): 
            $field_id_checked = 'checked="checked"';
        else:
            $field_id_checked = '';
        endif;
    ?>
    <input type="checkbox" name="allowed_to_parent" value="true" <?php echo $field_id_checked; ?>>
  </p>
<?php }

// Save the meta box's post metadata
function cwf_save_post_meta_from_box( $post_id, $post ) {
    // Verify the nonce before proceeding
    if ( !isset( $_POST['cwf_allow_parent_nonce'] ) || !wp_verify_nonce( $_POST['cwf_allow_parent_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    // Get the post type object
    $post_type = get_post_type_object( $post->post_type );

    // Check if the current user has permission to edit the post
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    // Get the posted data and sanitize it for use as an HTML class
    $new_meta_value = ( isset( $_POST['allowed_to_parent'] ) ? sanitize_html_class( $_POST['allowed_to_parent'] ) : '' );

    // Get the meta key
    $meta_key = 'allowed_to_parent';

    // Get the meta value of the custom field key
    $meta_value = get_post_meta( $post_id, $meta_key, true );

    // If a new meta value was added and there was no previous value, add it
    if ( $new_meta_value && '' == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );

    // If the new meta value does not match the old value, update it
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );

    // If there is no new meta value but an old value exists, delete it
    elseif ( '' == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );
}

?>