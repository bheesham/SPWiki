<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
<<<<<<< HEAD
	die( 'Direct script access is not allowed.' );
}
?>
		<p>
			&#91; <a href="revisions.php?l=<?php echo $this->wiki_page; ?>"><?php echo $this->lang['revisions']; ?></a> &#92; 
			<a href="edit.php?l=<?php echo $this->wiki_page; ?>"><?php echo $this->lang['edit']; ?></a> &#93;
		</p>
		</div>
	<?php foreach( $this->js as $js ): ?>
	<script src="<?php echo $js;?>" type="text/javascript"></script>
	<?php endforeach; ?>
=======
	die('Direct script access is not allowed.');
}
?>
	<!--
	<script src="template/default/script.js" type="text/javascript"></script>
	-->
>>>>>>> 72af57954bdea1e2188ef752c48261a7a1347576
	</body>
</html>