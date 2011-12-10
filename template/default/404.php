<?php
// Copyright (C) 2011 Bheesham Persaud.
if ( !defined( 'TEST' ) ) {
	die('Direct script access is not allowed.');
}
?>
<p>
	<?php echo $this->lang['page_does_not_exist']; ?><br />
	<a href="edit.php?l=<?php echo $this->wiki_page; ?>"><?php echo $this->lang['create_page']; ?></a>
</p>