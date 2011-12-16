<?php
// Copyright (C) 2011 Bheesham Persaud.
define( 'TEST', true );
include 'includes/bootstrap.php';

// Check to see if the page was cached.
$page_cache = Page::cached( sha1( $wiki_page ), true );
if ( $page_cache != false ) {
	echo $page_cache;
} else {
	$page_contents = Page::page_contents( $wiki_page );

	if ( $page_contents == false ) {
		$template->page_name = $lang['error_404'];
		$template->add_content( 'content', $template->loc . '404.php', true );
	} else {
		$template->add_content( 'content', $page_contents );
	}
	
	// Set up caching for this page
	$cache_file_name 	= sha1( $wiki_page );
	$template->compile( true, $cache_file_name );
}