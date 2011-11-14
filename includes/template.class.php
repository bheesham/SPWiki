<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die('Direct script access is not allowed.');
}

// A class to manage the template ( cache, display, etc )
class Template {
	
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
	
	function add_js( $js_src ) {
		$this->js[] = $js_src;
		return true;
	}
	
	function add_css( $css_src ) {
		$this->css[] = $css_src;
		return true;
	}
	
	function compile() {
		
		
		
		
		
	}
	
}