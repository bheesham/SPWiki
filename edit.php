<?php
// Copyright (C) 2011 Bheesham Persaud.
define( 'TEST', true );
include 'includes/bootstrap.php';

if ( isset( $_POST['edit_submit'] ) && isset( $_POST['edit_pass'] ) && $wiki_page != 'Index' ) {
	if ( sha1( $_POST['edit_pass'] ) == $password ) {
		
		$cache_file_name 	= sha1( $wiki_page ) . '.html';
		$cache_file 		= ROOT . 'cache/' . $cache_file_name;
		$new_cache_file 	= ROOT . 'cache/' . $wiki_page . '/' . time() . '.html';
		
		$revision_dir 		= ROOT . 'cache/' . $wiki_page . '/';
		
		
		// Move the file if it already exists, then rename it.
		if ( Page::cached( $wiki_page ) == true ) {
			if ( is_dir( ROOT . 'cache/' . $wiki_page . '/' ) == false ) {
				mkdir( $revision_dir );
			}
			rename( $cache_file, $new_cache_file );
		}
		
		$wiki_file = ROOT . 'content/' . $wiki_page . '.txt';
		
		$handle = fopen( $wiki_file, 'w' );
		$result = fwrite( $handle, $_POST['edit_wiki'] );
		if ( $result == false ) {
			trigger_error( "Could not write to the cache file: $wiki_file", E_USER_ERROR );
		}
		fclose( $handle );
		header( 'Location: index.php?' . $_SERVER['QUERY_STRING'] );
	} else {
		die( 'Wrong password.' );
	}
}


$template->add_file( $template->loc . 'header.php' );
$page_contents = Page::page_contents( $wiki_page );

$template->page_name = 'Editing: ' . $wiki_page;

$template->add_content( '<form action="edit.php?' . $_SERVER['QUERY_STRING'] . '" method="post">' );
$template->add_content( '<p><textarea name="edit_wiki" id="edit_wiki">' );
$template->add_content( $page_contents );
$template->add_content( '</textarea><br></p>' );
$template->add_content( '<p><label for="edit_pass">Password: </label> <input type="text" name="edit_pass" id="edit_pass"> <input type="submit" name="edit_submit" value="Submit"></p>' );
$template->add_content( '</form>' );

$template->add_js( 'ckeditor/ckeditor.js' );
$template->add_js( $template->loc . 'editor.js' );

$template->add_file( $template->loc . 'footer.php' );
$template->compile( );
