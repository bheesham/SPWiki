<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die( 'Direct script access is not allowed.' );
}

// A class to manage pages
class Page {

	// Will replace all special characters except for parenthesis with underscores.
	static function get_file_name( $page_name ) {
		$regexp = '@([^a-zA-Z0-9\(\)\-\.])@';
		return preg_replace( $regexp, '_', $page_name );
	}

	// Check to see if a cache file exists.
	static function cached( $wiki_page, $return_content = false ) {
		$cache_file = ROOT . 'cache/' . sha1( TEMPLATE_NAME . $wiki_page ) . '.html';
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
	
	// Checks to see if a certain wiki page exists.
	static function page_exists( $wiki_page ) {
		$contents	= ROOT . 'content/' . $wiki_page . '.txt';
		if ( file_exists( $contents ) ) {
			return true;
		}
		return false;
	}
	
	// Checks to see if a wiki page has revisions.
	static function has_revisions( $wiki_page ) {
		$contents 	= ROOT . 'content/' . $wiki_page . '.txt';
		$rev_dir 	= ROOT . 'content/' . $wiki_page . '/';
		// First of all, check to make sure that the file exists
		if ( !file_exists( $contents ) ) {
			return false;
		}
		
		if ( !is_dir( $rev_dir ) ) {
			mkdir( $rev_dir );
			return false;
		}
		
		// Next, check for revisions
		$files = 0;
		if ( $handle = opendir( $rev_dir ) ) {
		    while ( false !== ( $file = readdir( $handle ) ) ) {
		        if ( $file != '.' && $file != '..' ) {
		            $files++;
		        }
		    }
		    closedir($handle);
		}
		if ( $files == 0 ) {
			return false;
		}
		
		// If it gets here, then there are indeed revisions of the wiki page
		return true;
	}
	
	
	// Get the contents of the page file
	// Also, parse any wiki syntax here.
	static function page_contents( $location ) {
		// Get the contents
		$file = ROOT . 'content/' . $location . '.txt';
		if ( file_exists( $file ) ) {
			$handle = fopen( $file, "rb" );
			$contents = '';
			while ( !feof( $handle ) ) {
				$contents .= fread( $handle, 8192 );
			}
			fclose( $handle );
			
			// Parse page
			$contents = self::parser( $contents );
			
			return $contents;
		}
		return false;
	}
	
	// Parser
	static function parser( $contents ) {
		// Inner links
		$contents = preg_replace( '@\[w:([^\]]+)\]@i', 'index.php?l=$1', $contents );
		return $contents;
	}
}

