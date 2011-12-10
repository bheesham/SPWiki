<?php
// Copyright (C) 2011 Bheesham Persaud.
define( 'TEST', true );
include 'includes/bootstrap.php';

// Check to see if the page exists.
if ( Page::page_exists( $wiki_page ) == false ) {
	$template->add_file( $template->loc . 'header.php' );	
	$page_contents = Page::page_contents( $wiki_page );
	$template->page_name = $lang['error_404'];
	$template->add_file( $template->loc . '404.php' );
	$template->add_file( $template->loc . 'footer.php' );
	$template->compile( true );
} else {
	$template->add_file( $template->loc . 'header.php' );
	$template->page_name = $lang['revisions'] . ': ' . $template->page_name;
	
	$template->add_content( '<h1>' . $template->page_name . '</h1>' );
	$template->add_content( '<ul>' );
	
	$revision_dir 		= ROOT . 'cache/' . $wiki_page . '/';
	$revision_dir_index = $wiki_page . '/index';
	
	$dir_handle 		= opendir( $revision_dir );
	if ( $dir_handle ) {
		while ( ($file = readdir( $dir_handle ) ) !== false ) {
		    if ( !is_dir( $revision_dir . $file ) && $file != 'index.html' ) {
		    	$time = explode( '.', $file );
				$time = date( 'd/m/Y \a\t H:i:s', $time[0] );
		    	$template->add_content( "<li>$time</li>\r\n" );
		    }
		}
		closedir( $dir_handle );
	} else {
		die( $lang['open_dir_error'] );
	}
	
	$template->add_content( '</ul>' );
	$template->add_file( $template->loc . 'footer.php' );
	
	// Cache this page.
	$template->compile( true, $revision_dir_index );
}