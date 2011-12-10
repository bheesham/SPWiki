<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
<<<<<<< HEAD
	die( 'Direct script access is not allowed.' );
=======
	die('Direct script access is not allowed.');
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
}

// A class to manage the template ( cache, display, etc )
class Template {
<<<<<<< HEAD

	public $page_name;
	// Goes into the <title> tag
	public $wiki_page;
	// Actual wiki page
	public $loc;
	// Location of the template directory
	private $meta = array( );
	// Meta tags to add
	private $js = array( );
	// JS scripts to add
	private $css = array( );
	// Stylesheets to add
	private $content = array( );
	// The files and content to display

	function __construct( $locale, $lang ) {
		$this->locale = $locale;
		$this->lang = $lang;
		return true;
	}

	// Will simply include the file
	function add_file( $file ) {
		if ( !file_exists( $file ) ) {
			trigger_error( "$file does not exist.", E_USER_ERROR );
			return false;
		}
		$this->content[] = array( 'file', $file );
		return true;
	}

	// Will add HTML content
	function add_content( $content ) {
		$this->content[] = array( 'content', $content );
		return true;
	}

	function add_meta( $type, $name, $content ) {
		$this->meta[] = array( $type, $name, $content );
		return true;
	}

=======
	
	public $cache;
	private $content 			= array();
	public $meta 				= array();
	public $js 					= array();
	public $css 				= array();
	
	function __init__( $cache = false ) {
		$this->template_dir 	= $template_dir;
		$this->cache 			= $cache;
	}
	
	// Will simply include the file
	function add_file( $file ) {
		if ( !file_exists( $file ) ) { 
			trigger_error( "$file does not exist.", E_USER_ERROR );
			return false;
		}
		if ( !is_array( $file ) ) {
			$file = array( $file );
		}
		$this->content[]['file'] = $file;
		return true;
	}
	
	// Will add HTML content
	function add_content( $content ) {
		$this->content[]['content'] = $content;
		return true;
	}
	
	
	function add_meta( $type, $name, $content ) {
		$this->meta[] = array(
								$type,
								$name,
								$content
		);
		return true;
	}
	
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
	function add_js( $js_src ) {
		$this->js[] = $js_src;
		return true;
	}
<<<<<<< HEAD

=======
	
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
	function add_css( $css_src ) {
		$this->css[] = $css_src;
		return true;
	}
<<<<<<< HEAD

	function compile( $cache = false ) {
		// If this function is called, that means we need to cache the page,
		// unless we're told not to.
		if ( $cache == true ) {
			ob_start( );
			$output = '';
		}

		foreach ( $this->content as $content ) {
			if ( $content[0] == 'file' ) {
				include $content[1];
			} else {
				echo $content[1];
			}
		}
		
		if ( $cache == true ) {
			// Save the output to a file
			$output = ob_get_contents( );
			ob_end_flush( );
			$cache_file_name = sha1( $this->wiki_page ) . '.html';
			$cache_file = ROOT . 'cache/' . $cache_file_name;
			$handle = fopen( $cache_file, 'w' );
			$result = fwrite( $handle, $output );
			if ( $result == false ) {
				trigger_error( "Could not write to the cache file: $cache_file", E_USER_ERROR );
			}
			fclose( $handle );
		}
		return true;
	}

}
=======
	
	function compile() {
		
		
		
		
		
	}
	
}
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
