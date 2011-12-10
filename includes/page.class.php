<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
<<<<<<< HEAD
	die( 'Direct script access is not allowed.' );
=======
	die('Direct script access is not allowed.');
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
}

// A class to manage pages
class Page {
<<<<<<< HEAD

	// Will replace all special characters except for parenthesis with underscores.
	static function get_file_name( $page_name ) {
		$regexp = '@([^a-zA-Z0-9\(\)])@';
		return preg_replace( $regexp, '_', $page_name );
	}

	// Get the contents of the page file
	// Also, parse any wiki syntax here.
	static function page_contents( $file_name ) {
		$file = ROOT . 'content/' . $file_name . '.txt';

		if ( file_exists( $file ) ) {
			$handle = fopen( $file, "rb" );
			$contents = '';
			while ( !feof( $handle ) ) {
				$contents .= fread( $handle, 8192 );
			}
			fclose( $handle );
			return $contents;
		}
		return false;
	}

	static function cached( $wiki_page, $return_content = false ) {
		$cache_file_name = sha1( $wiki_page ) . '.html';
		$cache_file = ROOT . 'cache/' . $cache_file_name;
		// Does this file exist?
		if ( file_exists( $cache_file ) ) {
			if ( $return_content == false ) {
				return true;
			}
			$handle = fopen( $cache_file, 'rb' );
=======
	
	// Will replace all special characters except for parenthesis with underscores.
	static function get_file_name( $page_name ) {
		$regexp = '@([^a-z0-9\(\)])@i';
		return preg_replace( $regexp, '_', $page_name );
	}
	
	// Get the contents of the page file
	static function page_contents( $page ) {
		$file_name 	= self::get_file_name( $page );
		$file 		= ROOT . 'content/' . $file_name . '.json';
		if ( file_exists( $file ) ) {
			$handle = fopen( $file , "rb");
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
			$contents = '';
			while ( !feof( $handle ) ) {
				$contents .= fread( $handle, 8192 );
			}
			fclose( $handle );
			return $contents;
		}
		return false;
	}
<<<<<<< HEAD

}
=======
	
}
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
