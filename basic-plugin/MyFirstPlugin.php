<?php
/*
 Plugin Name:     My First Plugin
 Plugin URI:      http://www.example.com
 Description:     job opportunity
 Version:         1.0.0
 Author:          Hani
 Author URI:      http://www.example.com
 License:     GPL2
 */
//make a local var



//Exit if accessed directly
if(! defined('ABSPATH')){
	exit;
}

//include
//4 ways
//https://paulund.co.uk/difference-between-php-include-and-require
//if say iclude, it will  not show the error
//if say require it will show the error
//require ('MyFirstPlugin-list.php');
//include ('MyFirstPlugin-list.php');
require_once ( Plugin_dir_path ( __FILE__ ) . 'MyFirstPlugin-postType.php');
require_once ( Plugin_dir_path ( __FILE__ ) . 'MyFirstPlugin_fields.php');
require_once ( Plugin_dir_path ( __FILE__ ) . 'wp_mortgage_listing.php');
//Meta box

//add js, css
function wpdw_add_enqueue_script(){
	//edit.php   <=====   $pagenow    
	// the type <======== mortgage
	global $pagenow, $typenow;
	//var_dump($pagenow);
	//var_dump($typenow);
	//die();
	//OR
	//$screen = get_current_screen();
	//var_dump($screen);
	//die();
	//var_dump($screen->post_type);
	//if it show edit.php, u must use post.php
	//edit-post
	//posttpe is mortgage
	

	if ( $typenow == 'mortgage') {
		//					name   				path 							version
		wp_enqueue_style( 'wpdw-admin-css', plugins_url( 'css/admin-cal.css', __FILE__ ) );

	}


	if ( $pagenow =='edit.php' && $typenow == 'mortgage') {

		wp_enqueue_script( 'reorder-js', plugins_url( 'js/reorder.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), '20160720', true );
		
		wp_localize_script( 'reorder-js', 'WP_MORTGAGE_LISTING', array(
			'security' => wp_create_nonce( 'wp_mortgage_order' ),
			'success' => __( 'Mortgage sort order has been saved.' ),
			'failure' => __( 'There was an error saving the sort order, or you do not have proper permissions.' )
		) );

		/*
		// wp_localize_script( $handle, $name, $data );
		//check the console by WP_MORTGAGE_LISTING
		wp_localize_script( 'reorder-js', 'WP_MORTGAGE_LISTING', array(
			//var      =>   whatever
			'security' => wp_create_nonce( 'wp_mortgage_order' ),
			'success'  => __('Mortgage sort updated successfully.' ),
			//toye consol WP_MORTGAGE_LISTING.fail
			'fail' => __('There was an error to save the data in order that you want, or you don not have proper permission.')
			//'siteUrl' => get_bloginfo('url')
			 ) );
		 //check MyFirstluging.php, dwwp_mortgage_nonce is for security
*/
		}


	if( ($pagenow == 'post.php' || $pagenow == 'post-new.php' ) && $typenow == 'mortgage' ){
	 	//wp_enqueue_style( 'wpdw_admin_css', plugins_url('/css/admin-cal.css', __FILE__ ));	

							//name												//Dependency                                   version to date, footer
		// if we say false, css and js are gonna be at the top
		wp_enqueue_script( 'wpdw_admin_js', plugins_url('/js/admin-cal.js', __FILE__ ), array('jquery','jquery-ui-datepicker'),'20160718',true);
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

	    wp_enqueue_script( 'wpdw_quickTags', plugins_url('/js/wpdw_quicktags.js', __FILE__ ), array('quicktags'),'20160718',true);

	} 
}
add_action('admin_enqueue_scripts','wpdw_add_enqueue_script');
//add_action('wp_enqueue_scripts','wpdw_add_enqueue_script');


























