<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die( 'Direct script access is not allowed.' );
}

$template->add_meta( 'http-equiv', 'Content-Language', $template->locale );
$template->add_meta( 'name', 'generator', 'SPWiki' );
$template->add_css( $template->loc . 'style.css' );

$template->compile_order = array( 
									'header',  
									'content',  
									'footer' 
								);

$template->add_content( 'header', $template->loc . 'header.php', true );
$template->add_content( 'footer', $template->loc . 'footer.php', true );
$template->add_content( 'top_content', null );
$template->add_content( 'bottom_content', null );