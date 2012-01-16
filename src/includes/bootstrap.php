<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die( 'Direct script access is not allowed.' );
}
define( 'ROOT', dirname( __FILE__ ) . '/../' );

include ROOT . 'includes/config.php';
$password = sha1( $password );

include ROOT . 'includes/page.class.php';
include ROOT . 'includes/template.class.php';

// Load the language files
$language_file = ROOT . 'includes/language/' . $locale . '.php';
if ( !file_exists( $language_file ) ) {
	die( 'That language file does not exist.' );
}
include $language_file;

$template 				= new Template( $locale, $lang );
$template->site_name 	= $site_name;

// Load the template configuration but only if the template requires it.
define( 'TEMPLATE_NAME', sha1( $template_name ) );
$template_path 		= 'template/' . $template_name . '/';
$template_config 	= ROOT . 'template/' . $template_name . '/config.php';
if ( !file_exists( $template_config ) ) {
	die( 'That template does not exist.' );
}
$template->loc = $template_path;
include $template_config;

// Get the page that the user is currently viewing
if ( isset( $_GET['l'] ) && !empty( $_GET['l'] ) ) {
	$wiki_page = $_GET['l'];
} else {
	$wiki_page = 'Index';
}
$wiki_page = Page::get_file_name( $wiki_page );

// Set a few template variables.
$template->wiki_page = $wiki_page;
$template->page_name = str_replace( '_', ' ', $wiki_page );
