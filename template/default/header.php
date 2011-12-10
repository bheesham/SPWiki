<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
<<<<<<< HEAD
	die( 'Direct script access is not allowed.' );
}
?>
<!doctype html>
<html lang="<?php echo $this->locale; ?>">
	<head>
		<title><?php
		echo htmlspecialchars( $this->site_name );
		if ( isset( $this->page_name ) && !empty( $this->page_name ) ) {
			echo ' - ' . $this->page_name;
		} else {
			echo ' - ' . $this->lang['index'];
		}
			?></title>
		<?php foreach( $this->meta as $meta ): ?>
		<meta <?php echo $meta[0];?>="<?php echo $meta[1];?>" content="<?php echo $meta[2];?>">
		<?php endforeach;?>
		<?php foreach( $this->css as $css ): ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $css;?>">
		<?php endforeach; ?>
	</head>
	<body>
		<div id="container">
=======
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
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
