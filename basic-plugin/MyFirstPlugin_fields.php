<?php
function wpdw_register_meta_boxes() {
    add_meta_box( 
    	'dwwp_meta',//id
    	'Mortgage Calulation',//title
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
	wp_nonce_field( basename( __FILE__ ), 'dwwp_mortgage_nonce' );
	$dwwp_stored_meta = get_post_meta( $post->ID ); ?>
	
	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="mortgage_id" class="dwwp-row-title">Mortgage ID</label>
			</div>
				
			<div class="meta-td">
				<input type="text" name="mortgage_id" id="mortgage_id"
				value="<?php if ( ! empty ( $dwwp_stored_meta['mortgage_id'] ) )
					echo esc_attr( $dwwp_stored_meta['mortgage_id'][0] );
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
		$editor = 'principle_duties';
		$settings = array(
			'textarea_rows' => 8,
		);
		wp_editor( $content, $editor, $settings); ?>
	
</div>
<?php
	
}
