
<?php
//create post 
function wpwd_create_post_type() {

    $singular='Mortgage Calcultion';
	$plural='Mortgage Calcultions';

	$labels = array(
		'name' 				=> $plural,
		'singular_name'	 	=> $singular, 
		'add_name' 			=> 'Add New', 
		'add_new_item' 		=> 'Add New' . $singular,
		'edit'				=> 'Edit',
		'edit_item' 	    => 'Edit'. $singular,
		'new_item' 			=> 'New Item' . $singular,
		'view' 				=> 'View Item' . $singular,
		'view_item'			=> 'View Item' . $singular,
		'search_term' 		=> 'Search' . $plural,
		'parent' 			=> 'Parent' . $singular,
		'not_found'		    => 'No ' . $plural . ' found',
		'not_found_in_trash' => 'No '. $plural . ' in trash'
			);
//			post type, argu
	//hierarchical  act like post or page post========true
  $args = array(
  	'labels'             => $labels,
	'public'             => true,
	'publicly_queryable' => true,
	'exclude_from_search'=> false,
	'show_in_nav_menus'  => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'show_in_admin_bar'  => true,
	'menu_position'		 => 10,
	'menu_icon'			 => 'dashicons-building',
	'can_export'		 => true,
	'delete_with_user'	 => false,
	'hierarchical'       => false,
	'has_archive'        => true,
	'query_var'          => true,
	'capability_type'    => 'post',
	'map_meta_cap'		 => true,	
	//'capabilities' =>  array(),
	'rewrite'            => array( 
		'slug'           => 'mortgage',
		'with_front'	 => true,
	    'pages'		     => true,
	    'feeds'	    	 => true,
	 ),
	//vaghti in supprot aro nevehstim hala  hamaye meta booaro ovord
	//hala pakesh mikonim ta MyFirstPlugin_render_admin ino check kon
	'supports'           => array(
	'title'//,
    //'editor',
	//'author',
    //'custom-fields',
	//'thumbnail', 
	//'excerpt', 
	//'comments', 
	//'trackbacks',
	//'revisions',
	//'page-attributes',
	//'post-formats' 
	)
  	);
	//			   post type, args 
  register_post_type( 'mortgage', $args);
  
}
add_action( 'init', 'wpwd_create_post_type' );


//do u want ur taxonomy to have a parent child like category do? or u dont wan tto have parent child like taxonomy
//taxonomy
//yani zire oon icon ke dorost kardim hala bachasho dorost konim
function wpdw_register_taxonomy(){
	$singular = 'Location';
	$plural = 'Locations';

$labels = array(
		'name'                       => $plural,
        'singular_name'              => $singular,
        'search_items'               => 'Search ' . $plural,
        'popular_items'              => 'Popular ' . $plural,
        'all_items'                  => 'All ' . $plural,
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit ' . $singular,
        'update_item'                => 'Update ' . $singular,
        'add_new_item'               => 'Add New ' . $singular,
        'new_item_name'              => 'New ' . $singular . ' Name',
        'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
        'add_or_remove_items'        => 'Add or remove ' . $plural,
        'choose_from_most_used'      => 'Choose from the most used ' . $plural,
        'not_found'                  => 'No ' . $plural . ' found.',
        'menu_name'                  => $plural,
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'location' ),
									//same be same as taxonomy
		);


	//$taxonomy, $object_type, $args
	//it must be uk
	//obj type must be same as post type
	register_taxonomy( 'location','mortgage',$args );
}
add_action( 'init', 'wpdw_register_taxonomy' );



//remove something in wordpress
function dwwp_remove_dashboard() {
	//id, page, context
	remove_meta_box('dashboard_primary','dashboard','side');
}
add_action('wp_dashboard_setup','dwwp_remove_dashboard');

//add wordpress website oon balaye site
function dwwp_addWordPressLink(){
global $wp_admin_bar;

$wp_admin_bar->add_menu(array(
	'id' => 'wp_API',
	'title' => 'wpAPI',
	'href' => 'https://codex.wordpress.org/Plugin_API/'
	));

}
add_action('wp_before_admin_bar_render','dwwp_addWordPressLink');




 /*
$wp_options = get_option('wpsettings');

$homeprice = $wp_options['homeprice'];
$downpayment = $wp_options['downpayment'];
$loanprogram = $wp_options['loanprogram'];
$interestrate = $wp_options['interestrate'];
add_action('admin_menu', 'myFirstplugin_admin_actions');


//compare article
$wp_article = similar_text($homeprice, $downpayment,$rs);

function myFirstplugin_admin_actions() {
	//		1)title  /2)name of the sub menu(dashboard)/3)who can view the sub menu/4)menu slug /5)display the menu page
	add_options_page('myFirstplugin', 'myFirstplugin', 'manage_options', __FILE__, 'myFirstplugin_admin');
}

function myFirstplugin_admin() {
	global $wp_options;
	global $rs;
	ob_start();
	?>
	<h1>Mortgage Cal</h1>
<div class="wrap">

<form action="options.php" method="POST">
	<?php settings_fields('wpsettinggroup'); ?>
Home Price
<input type="text" name="wpsettings[homeprice]"><?php echo $wp_options['homeprice'];?><br />
Down payment
<input type="text" name="wpsettings[downpayment]"><?php echo $wp_options['downpayment'];?><br />
Loan Program
<input type="text" name="wpsettings[loanprogram]"><?php echo $wp_options['loanprogram'];?><br />
Intrest rate
<input type="text" name="wpsettings[interestrate]"><?php echo $wp_options['interestrate'];?><br />
<input type="submit" name="btncal" class="button-primary" value="Calculate"/>
<input type="button" class="button" value="<?php echo $rs. '%';?>">

</form>
</div>


	<?php
	echo ob_get_clean();
}


//http://localhost/cal/wp-admin/options-general.php?page=basic-plugin%2FMyFirstPlugin.php
///Applications/XAMPP/xamppfiles/htdocs/cal/wp-content/plugins
/*
function addImage($post){
$logoOfSavemax = "<img src='http://localhost/cal/wp-content/plugin/savemaxlogo.png align='left'>";
$logoOfSavemax.=$post;
return $logoOfSavemax;
}
add_filter("the_content","addImage");


//install reg and save it to db
function wp_reg(){
register_setting('wpsettinggroup','wpsettings');
}
add_action('admin_init','wp_reg');

*/


?>





