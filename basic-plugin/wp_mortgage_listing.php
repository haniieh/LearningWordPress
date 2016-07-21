<?php
function wpwd_add_submenu(){
//add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
	add_submenu_page( 
		'edit.php?post_type=mortgage',//https://codex.wordpress.org/Administration_Menus
		 'Reorder Mortgage',
		 'Reorder Mortgage', 
		 'manage_options', 
		 'reorder_mortgage',//pc readable name
		 'reorder_admin_mortgage_callback'
		 );
}
add_action('admin_menu','wpwd_add_submenu');

function reorder_admin_mortgage_callback(){
	//global $typenow,$pagenow;

	$args = array(
		'post_type'					=> 'mortgage',
		'oder_by'					=> 'menu_order',
		'oder'						=> 'ASC',
		'post_status'				=> 'publish',
		'no_found_rows'				=> true,
		'update_post_term_cache'	=>false, // dont use taxonomy
		'post_per_post'				=>50
		//'category_name' => 'cat-a'
		);
	$mortgage_listing = new WP_Query($args);

	// echo "<pre>";
	// var_dump($mortgage_listing->get_posts());
	// echo "</pre>";
	?>
	<div class="mortgage_list" class='wrap'>
		<div class="icon32" id="icon-mortgage-admin" ><br /></div>
		<!--To make a pic dynamic       translatable string _e()    -->
		<h2><?php _e( 'Sort Mortgage Listing','wp-mortgage-listing' );?><img src="<?php echo esc_url( admin_url() . '/images/loading.gif' ); ?>" id="loading-animation" class="loading-animation"></h2> 
		<?php   
		//if it exist
			if($mortgage_listing->have_posts()) : 
		?>
		<p><?php _e('<strong>Notice:</strong> Mortage exists. :)') ?></p>

		<ul class="custom-type-list">
			<?php while($mortgage_listing->have_posts()) : $mortgage_listing->the_post();?>
			<li id="<?php esc_attr( the_id() ); ?>"><?php esc_html( the_title() ); ?></li>
		<?php endwhile;?>
		</ul>
	<?php else:?>
	<p> <?php _e('You have no list','wp-mortgage-listing'); ?></p>
<?php endif;?>
	</div>

	<?php

//var_dump($pagenow);
//var_dump($typenow);

}
/*
	//processing Ajx Req in WordPress
	//saving data from Ajax to database
function dwwp_save_reorder() {

		//wp_send_json_error( 'sucks' );
		//check_ajax_referer( $action, $query_arg, $die )
		//check yhe MyFirtPlugin 'security' => wp_create_nonce('      wp_mortgage_order      '),
		//if there is a securtiy to access
		
		if ( ! check_ajax_referer( 'wp_mortgage_order','security' ) ) {
			return wp_send_json_error( 'Invalid Nonce' );
		}
		//if its not an admin
		if ( ! current_user_can( 'manage_options' ) ) {
		return wp_send_json_error( 'You are not allow to do this.' );
	}

		//save data 
		//check the order.js , we have an array of order
	$order = $_POST['order'];
	$counter = 0;

	foreach( $order as $item_id ) {

		$post = array(
			'ID' => (int)$item_id,
			'menu_order' => $counter,
		);

		wp_update_post( $post );

		$counter++;
	}

	wp_send_json_success( 'Post Saved.' );

	}
add_action( 'wp_ajax_save_sort', 'dwwp_save_reorder' );//esmesh bayad wp_ajax_   ma baghish az action to reorder miyad
*/



function dwwp_save_reorder() {

	if ( ! check_ajax_referer( 'wp_mortgage_order', 'security' ) ) {
		return wp_send_json_error( 'Invalid Nonce' );
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		return wp_send_json_error( 'You are not allow to do this.' );
	}

	$order = $_POST['order'];
	$counter = 0;

	foreach( $order as $item_id ) {

		$post = array(
			'ID' => (int)$item_id,
			'menu_order' => $counter,
		);

		wp_update_post( $post );

		$counter++;
	}

	wp_send_json_success( 'Post Saved.' );

}
add_action( 'wp_ajax_save_sort', 'dwwp_save_reorder' );










