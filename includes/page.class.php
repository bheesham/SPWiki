<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die('Direct script access is not allowed.');
}

// A class to manage pages
class Page {
	
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
			$contents = '';
			while ( !feof( $handle ) ) {
				$contents .= fread( $handle, 8192 );
			}
			fclose( $handle );
			return $contents;
		}
		return false;
	}
	
}