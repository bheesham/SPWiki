<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die( 'Direct script access is not allowed.' );
}

$template->add_meta( 'http-equiv', 'Content-Language', $template->locale );
$template->add_meta( 'name', 'generator', 'SPWiki' );
$template->add_css( $template->loc . 'style.css' );
