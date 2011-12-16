<?php
// Copyright (C) 2011 Bheesham Persaud.
define( 'TEST', true );
include 'includes/bootstrap.php';

if ( isset( $_POST['edit_submit'] ) && isset( $_POST['edit_pass'] ) ) {
	if ( sha1( $_POST['edit_pass'] ) == $password ) {
			
		$wiki_file_path 	= ROOT . 'content/' . $wiki_page . '.txt';
		
		$cache_file_name 	= sha1( $wiki_page ) . '.html';
		$cache_file 		= ROOT . 'cache/' . $cache_file_name;
		// The modified time. Meaning the time the cached version was created.
		$new_cache_file 	= ROOT . 'cache/' . $wiki_page . '/' . filemtime( $wiki_file_path ) . '.html';
		
		$revision_dir 		= ROOT . 'cache/' . $wiki_page . '/';
		
		if ( !is_dir( $revision_dir ) ) {
			mkdir( $revision_dir );
		}
		
		// Move the file if it already exists, then rename it.
		if ( Page::cached( sha1( $wiki_page ) ) == true ) {
			if ( Page::has_revisions( $wiki_page ) == true ) {
				unlink( $revision_dir . 'index.html' );
			}
			// Save the current copy as a revision.
			copy( $cache_file, $new_cache_file );
			// Delete the cache file.
			unlink( $cache_file );
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
$template->compile( );
