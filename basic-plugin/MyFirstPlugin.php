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
require_once ( Plugin_dir_path ( __FILE__ ) . 'MyFirstPlugin_render_admin.php');
//Meta box
