<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die( 'Direct script access is not allowed.' );
}

// A class to manage pages
class Page {

	// Will replace all special characters except for parenthesis with underscores.
	static function get_file_name( $page_name ) {
		$regexp = '@([^a-zA-Z0-9\(\)])@';
		return preg_replace( $regexp, '_', $page_name );
	}

	// Get the contents of the page file
	// Also, parse any wiki syntax here.
	static function page_contents( $location ) {
		$file = ROOT . 'content/' . $location . '.txt';

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

	static function cached( $location, $return_content = false ) {
		$cache_file = ROOT . 'cache/' . $location . '.html';
		// Does this file exist?
		if ( file_exists( $cache_file ) ) {
			if ( $return_content == false ) {
				return true;
			}
			$handle = fopen( $cache_file, 'rb' );
			$contents = '';
			while ( !feof( $handle ) ) {
				$contents .= fread( $handle, 8192 );
			}
			fclose( $handle );
			return $contents;
		}
		return false;
	}
	
	static function page_exists( $wiki_page ) {
		$contents	= ROOT . 'content/' . $wiki_page . '.txt';
		if ( file_exists( $contents ) ) {
			return true;
		}
		return false;
	}
	
	static function has_revisions( $wiki_page ) {
		$contents 	= ROOT . 'content/' . $wiki_page . '.txt';
		$cache 		= ROOT . 'cache/' . sha1( $wiki_page ) . '.html';
		$rev_dir 	= ROOT . 'cache/' . $wiki_page . '/';
		if ( file_exists( $contents ) && file_exists( $cache ) && is_dir( $rev_dir ) ) {
			return true;
		}
		return false;
	}
	
}

