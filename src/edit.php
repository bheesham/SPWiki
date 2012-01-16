<?php
// Copyright (C) 2011 Bheesham Persaud.
define( 'TEST', true );
include 'includes/bootstrap.php';

if ( isset( $_POST['edit_submit'] ) && isset( $_POST['edit_pass'] ) ) {
	if ( sha1( $_POST['edit_pass'] ) == $password ) {
			
		// Location of the wiki page
		$wiki_file_path 	= ROOT . 'content/' . $wiki_page . '.txt';
		
		// Old cache file
		$cache_file 		= ROOT . 'cache/' . sha1( $wiki_page ) . '.html';
		
		// Revision Directory Index
		$revision_dir_index	= ROOT . 'cache/' . sha1( $wiki_page . 'revision_index' ) . '.html';
		
		if ( !is_dir( $revision_dir ) ) {
			mkdir( $revision_dir );
			
		}
		
		// Save the current copy as a revision.
		if ( Page::page_exists( $wiki_page ) ) {
			
			// The modified time. Meaning the time the cached version was created.
			$revision_file 		= ROOT . 'content/' . $wiki_page . '/' . filemtime( $wiki_file_path ) . '.txt';
			
			copy( $wiki_file_path, $revision_file );
			
			// Delete the old cache file
			if ( Page::cached( $wiki_page ) ) {
				unlink( $cache_file );
			}
			
			// Delete the old revision index
			if ( Page::has_revisions( $wiki_page ) == true ) {
				unlink( $revision_dir_index );
			}
			
		}
		
		$handle = fopen( $wiki_file_path, 'w' );
		$result = fwrite( $handle, $_POST['edit_wiki'] );
		if ( $result == false ) {
			trigger_error( $lang['could_not_write_cache'] . ': ' . $wiki_file_path, E_USER_ERROR );
		}
		fclose( $handle );
		
		header( 'Location: index.php?' . $_SERVER['QUERY_STRING'] );
	} else {
		die( $lang['wrong_password'] );
	}
}

$page_contents = Page::page_contents( $wiki_page );

$template->page_name = $lang['editing'] . ': ' . $template->page_name;

$template->add_content( 'content', '<form action="edit.php?' . $_SERVER['QUERY_STRING'] . '" method="post">' );
$template->add_content( 'content', '<p><textarea name="edit_wiki" id="edit_wiki">' );
$template->add_content( 'content', $page_contents );
$template->add_content( 'content', '</textarea><br></p>' );
$template->add_content( 'content', '<p><label for="edit_pass">' . $lang['password'] . ': </label> <input type="text" name="edit_pass" id="edit_pass"> <input type="submit" name="edit_submit" value="' . $lang['submit'] . '"></p>' );
$template->add_content( 'content', '</form>' );

$template->add_js( 'ckeditor/ckeditor.js' );
$template->add_js( $template->loc . 'editor.js' );

// No caching for this page.
$template->compile();
