<?php
// Copyright (C) 2011 Bheesham Persaud.
define( 'TEST', true );
include 'includes/bootstrap.php';

// Check to see if the page exists.
if ( Page::page_exists( $wiki_page ) == false ) {	
	$page_contents = Page::page_contents( $wiki_page );
	$template->page_name = $lang['error_404'];
	$template->add_content( '', $template->loc . '404.php', true );
	$template->compile( true );
} else {
	// View the revision, or see the list of revisions made
	if ( isset( $_GET['view'] ) && !empty( $_GET['view'] ) ) {
		$page_rev = Page::cached( $wiki_page . '/' . $_GET['view'] , true );
		if ( $page_rev != false ) {
			echo $page_rev;
		} else {
			$template->page_name = $lang['error_404'];
			$template->add_content( 'content', $template->loc . '404.php', true );
			$template->compile();
		}
	} else {
		// Check to see if this page is cached. If not, cache it.
		$page_cache = Page::cached( $wiki_page . '/index' , true );
		if ( $page_cache != false ) {
			echo $page_cache;
		} else {
			$template->page_name = $lang['revisions'] . ': ' . $template->page_name;
			$template->add_content( 'content', '<h1>' . $template->page_name . '</h1>' );
			
			if ( Page::has_revisions( $wiki_page ) ) {
				$template->add_content( 'content', '<ul>' );
				$revision_dir 		= ROOT . 'content/' . $wiki_page. '/';
				$dir_handle 		= opendir( $revision_dir );
				if ( $dir_handle ) {
					while ( ( $file = readdir( $dir_handle ) ) !== false ) {
					    if ( !is_dir( $revision_dir . $file ) ) {
					    	// Display the time that each revision was made
					    	$time 		= explode( '.', $file );
							$time 		= $time[0];
							$date 		= date( 'd/m/Y \a\t H:i:s', $time );
							$view_url 	= "revisions.php?l=$wiki_page&amp;view=$time";
					    	$template->add_content( 'content', "<li>$date - <a href=\"$view_url\">View</a></li>\r\n" );
					    }
					}
					closedir( $dir_handle );
				} else {
					die( $lang['open_dir_error'] );
				}
				$template->add_content( 'content', '</ul>' );	
			} else {
				$template->add_content( 'content', "<p>No revisions.</p>" );
			}
			// Cache this page.
			$template->compile( true, $wiki_page . 'revision_index' );
		}
	}
}