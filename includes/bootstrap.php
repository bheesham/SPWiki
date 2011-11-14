<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die('Direct script access is not allowed.');
}
define( 'ROOT', dirname(__FILE__) . '/../' );

include ROOT . 'includes/config.php';
$password = md5( $password );

include ROOT . 'includes/page.class.php';
include ROOT . 'includes/template.class.php';

// Load the language files
$language_file = ROOT . 'includes/language/' . $language . '.php';
if ( !file_exists( $language_file ) ) {
	die('That language file does not exist.');
}
include $language_file;


$template = new Template( $caching );

// Load the template configuration but only if the template requires it.
$template_path 		= 'template/' . $template_name . '/';
$template_config 	= ROOT . 'template/' . $template_name . '/config.php';
if ( !file_exists( $template_config ) ) {
	die('That template does not exist.');
}
include $template_config;

// Get the page that the user is currently viewing
if ( isset( $_GET['l'] ) && !empty( $_GET['l'] ) ) {
	$wiki_page = $_GET['l'];
} else {
	$wiki_page = 'Index';
}