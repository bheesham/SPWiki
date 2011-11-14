<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die('Direct script access is not allowed.');
}
?>
<!doctype html>
<html lang="<?php echo $language; ?>">
	<head>
		<title><?php 	
						echo htmlspecialchars( $site_name ); 
						if ( isset( $page_name ) && !empty( $page_name ) ) {
							echo " - $page_name";
						} else {
							echo " - $lang_index";
						}
		?></title>
		<meta http-equiv="Content-Language" content="<?php echo $language; ?>" />
		<link rel="stylesheet" href="template/default/style.css">
	</head>
	<body>