<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
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
	</body>
</html>