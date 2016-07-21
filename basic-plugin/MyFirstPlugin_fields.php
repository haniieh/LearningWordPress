<?php
function wpdw_register_meta_boxes() {
    add_meta_box( 
    	'dwwp_meta',//id
    	__( 'Mortgage Calulation' ),//title
    	'wpdw_meta_callback', //callback// bayad be function toye MyFirstPlugin_render_admin.php b in esm besazim
    	//what kind of post type
    	'mortgage',//post type
    	'normal',
    	'core'

     );
}
add_action( 'add_meta_boxes', 'wpdw_register_meta_boxes' );

//show the text box and meta box of posting
//to post and save data, we need to say $post
function wpdw_meta_callback($post){
	//to save data in form we must use wp_nonce_field
	//make sure someone is typing in ur form and it's not a hacker
	//wp_nonce_field( int|string $action = -1, string $name = "_wpnonce", bool $referer = true, bool $echo = true )
	wp_nonce_field( basename( __FILE__ ), 'dwwp_mortgage_nonce' );//dwwp_mortgage_nonce   is a security
	$dwwp_stored_meta = get_post_meta( $post->ID ); ?>
	
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="mortgage_id" class="dwwp-row-title"><?php _e('Mortgage ID', 'wp-mortgage-listing');?></label>
			</div>
				
			<div class="meta-tr">
				<input type="text" name="mortgage_id" id="mortgage_id" class="dwwp-row-title"
				value="<?php if ( ! empty ( $dwwp_stored_meta['mortgage_id'] ) )
				////checking to going out is safe =======> sanitize_text_field
					echo esc_attr( $dwwp_stored_meta['mortgage_id'][0] );
				?>"/>
			</div>
		</div>



		
		<div class="meta-row">
			<div class="meta-th">
				<label for="homeprice" class="dwwp-row-title"><?php _e( 'Home Price', 'wp-mortgage-listing');?></label>
			</div>
				
			<div class="meta-tr">
				<input type="text" name="homeprice" id="homeprice" class="dwwp-row-content"
				value="<?php if ( ! empty ( $dwwp_stored_meta['homeprice'] ) )
					echo esc_attr( $dwwp_stored_meta['homeprice'][0] );
				?>"/>
			</div>
		</div>


	
		<div class="meta-row">
			<div class="meta-th">
				<label for="downpayment" class="dwwp-row-title"><?php _e('Down Payment','wp-mortgage-listing');?></label>
			</div>
				
			<div class="meta-tr">
				<input type="text" name="downpayment" id="downpayment" class="dwwp-row-content"
				value="<?php if ( ! empty ( $dwwp_stored_meta['downpayment'] ) )
					echo esc_attr( $dwwp_stored_meta['downpayment'][0] );
				?>"/>
			</div>
		</div>


		<div class="meta-row">
			<div class="meta-th">
				<label for="loanprogram" class="dwwp-row-title"><?php _e('Loan Program','wp-mortgage-listing');?></label>
			</div>
				
			<div class="meta-tr">
				<input type="text" name="loanprogram" id="loanprogram" class="dwwp-row-content"
				value="<?php if ( ! empty ( $dwwp_stored_meta['loanprogram'] ) )
					echo esc_attr( $dwwp_stored_meta['loanprogram'][0] );
				?>"/>
			</div>
		</div>


		<div class="meta-row">
			<div class="meta-th">
				<label for="interestrate" class="dwwp-row-title"><?php _e('interestrate','wp-mortgage-listing');?></label>
			</div>		
			<div class="meta-tr">
				<input type="text" size="5" name="interestrate" id="interestrate" class="dwwp-row-content"
				value="<?php if ( ! empty ( $dwwp_stored_meta['interestrate'] ) )
					echo esc_attr( $dwwp_stored_meta['interestrate'][0] );
				?>"/>
			</div>
		</div>


	<div class="meta-row">
			<div class="meta-th">
				<label for="app_deadline" class="dwwp-row-title"><?php _e('Deadline','wp-mortgage-listing')?></label>
			</div>		
			<div class="meta-tr">
				<input type="text" size="10" name="app_deadline" id="app_deadline" class="dwwp-row-content datepicker"
				value="<?php if ( ! empty ( $dwwp_stored_meta['app_deadline'] ) )
					echo esc_attr( $dwwp_stored_meta['app_deadline'][0] );
				?>"/>
			</div>
		</div>


<div class="meta">
	<div class="meta-th">
		<span>Principle Duties</span>
	</div>
</div>
<!--https://codex.wordpress.org/Function_Reference/wp_editor-->
<!--wp_editor-->
<div class="meta-editor">

	<?php
	//to show the metx box 
	//post id, key, boolean
	$content = get_post_meta( $post->ID, 'principle_duties', true );
		$editor = 'principle_duties';//bayad post vasash dorost konim
		$settings = array(
			'textarea_rows' => 8,
		);
		wp_editor( $content, $editor, $settings); ?>
	

		 <div class="meta-row">
			<div class="meta-th">
				<label for="someText" class="someText"><?php _e('Some Text(Just for fun)','wp-mortgage-listing');?></label>
			</div>		
	        <div class="meta-tr">
	          <textarea name="someText" class="dwwp-textarea" id="someText" class="dwwp-row-content"><?php
			          if ( ! empty ( $dwwp_stored_meta['someText'] ) ) {
			            echo esc_attr( $dwwp_stored_meta['someText'][0] );
			          }
		          ?>
	          </textarea>
	        </div>
	    </div>


	    <div class="meta-row">
	        <div class="meta-th">
	          <label for="YesNo" class="dwwp-row-title"><?php _e('Yes Or No( Just for fun)','wp-mortgage-listing');?></label>
	        </div>
	        <div class="meta-td">
	          <select name="YesNo" id="YesNo" class="dwwp-row-title">
		          <option value="Yes" <?php if ( ! empty ( $dwwp_stored_meta['YesNo'] ) ) selected( $dwwp_stored_meta['YesNo'][0], 'Yes' ); ?>>YES</option>';
		          <option value="No" <?php if ( ! empty ( $dwwp_stored_meta['YesNo'] ) ) selected( $dwwp_stored_meta['YesNo'][0], 'No' ); ?>>NO</option>';
	          </select>
	    </div> 
	</div>	


</div>
<?php
	
}

function wpwd_meta_save($post_id){
	$is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    //is it save and does it match
    $is_valid_nonce = ( isset( $_POST[ 'dwwp_mortgage_nonce' ] ) && wp_verify_nonce( $_POST[ 'dwwp_mortgage_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    //if its not empty , post
     if ( isset( $_POST[ 'mortgage_id' ] ) ) {
     	//update_post_meta($post_id, $meta_key, $meta_value, $prev_value);
     	//sanitize_text_field to have a very save data
     	//checking to going out is safe =======> sanitize_text_field
    	update_post_meta( $post_id, 'mortgage_id', sanitize_text_field( $_POST[ 'mortgage_id' ] ) );
    }

	if ( isset( $_POST[ 'homeprice' ] ) ) {
    	update_post_meta( $post_id, 'homeprice', sanitize_text_field( $_POST[ 'homeprice' ] ) );
    }

    if ( isset( $_POST[ 'downpayment' ] ) ) {
    	update_post_meta( $post_id, 'downpayment', sanitize_text_field( $_POST[ 'downpayment' ] ) );
    }

    if ( isset( $_POST[ 'loanprogram' ] ) ) {
    	update_post_meta( $post_id, 'loanprogram', sanitize_text_field( $_POST[ 'loanprogram' ] ) );
    }

    if ( isset( $_POST[ 'interestrate' ] ) ) {
    	update_post_meta( $post_id, 'interestrate', sanitize_text_field( $_POST[ 'interestrate' ] ) );
    }

    if ( isset( $_POST[ 'app_deadline' ] ) ) {
    	update_post_meta( $post_id, 'app_deadline', sanitize_text_field( $_POST[ 'app_deadline' ] ) );
    }

    if ( isset( $_POST[ 'principle_duties' ] ) ) {
    	update_post_meta( $post_id, 'principle_duties', sanitize_text_field( $_POST[ 'principle_duties' ] ) );
    }

    if ( isset( $_POST[ 'someText' ] ) ) {
    	update_post_meta( $post_id, 'someText', sanitize_text_field( $_POST[ 'someText' ] ) );
    }

    if ( isset( $_POST[ 'YesNo' ] ) ) {
    	update_post_meta( $post_id, 'YesNo', sanitize_text_field( $_POST[ 'YesNo' ] ) );
    }

}
add_action('save_post','wpwd_meta_save');



