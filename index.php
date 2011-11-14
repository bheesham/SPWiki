<?php
// Copyright (C) 2011 Bheesham Persaud.
define( 'TEST', true );
include 'includes/bootstrap.php';



$page_contents = Page::page_contents( $wiki_page );
if ( $page_contents == false ) {
	
}

include $template_path . 'header.php';

include $template_path . 'footer.php';