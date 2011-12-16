<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die( 'Direct script access is not allowed.' );
}

// A class to manage the template ( cache, display, etc )
class Template {
	
	// Goes into the <title> tag
	public $page_name;
	// Actual wiki page
	public $wiki_page;
	// Location of the template directory
	public $loc;
	// What's the compile order?
	public $compile_order;
	// Meta tags to add
	private $meta = array( );
	// JS scripts to add
	private $js = array( );
	// Style sheets to add
	private $css = array( );
	// The files and content to display
	private $content = array( );
	
	// When we construct it, pass a few variables along right away!
	function __construct( $locale, $lang ) {
		$this->locale = $locale;
		$this->lang = $lang;
		return true;
	}
	
	// Add meta tags
	function add_meta( $type, $name, $content ) {
		$this->meta[] = array( $type, $name, $content );
		return true;
	}
	
	// Add JavaScript sources
	function add_js( $js_src ) {
		$this->js[] = $js_src;
		return true;
	}
	
	// Add style sheets
	function add_css( $css_src ) {
		$this->css[] = $css_src;
		return true;
	}
	
	// Will add content
	function add_content( $placement, $content, $is_file = false ) {
		if ( $is_file == true ) {
			if ( !file_exists( $content ) ) {
				trigger_error( $file . $this->lang['does_not_exist'], E_USER_ERROR );
				return false;
			}
			$this->content[$placement][] = array( 'file', $content );
			return true;
		}
		$this->content[$placement][] = array( 'text', $content );
		return true;
	}
	
	// Compile it all!
	function compile( $cache = false, $location = '' ) {
		// If this function is called, that means we need to cache the page,
		// unless we're told not to.
		if ( $cache == true ) {
			ob_start( );
			$output = '';
		}
		
		foreach ( $this->compile_order as $key ) {
			if ( isset( $this->content[$key] ) && !empty( $this->content[$key] ) ) {
				foreach ( $this->content[$key] as $content ) {
					if ( $content[0] == 'file' ) {
						include $content[1];
					} else {
						echo $content[1];
					}
				}	
			}
		}
		
		if ( $cache == true ) {
			// Save the output to a file
			$output = ob_get_contents( );
			ob_end_flush( );
			$handle = fopen( ROOT . 'cache/' . $location . '.html', 'w' );
			$result = fwrite( $handle, $output );
			if ( $result == false ) {
				trigger_error( $this->lang['could_not_write_cache'] . ': ' . $cache_file, E_USER_ERROR );
			}
			fclose( $handle );
		}
		return true;
	}

}
