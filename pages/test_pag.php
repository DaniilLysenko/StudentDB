<ul class="pagination">
	<li class="page-item"><a class="page-link" href="/index.php?page=<?php if ($current_page > 1) echo $current_page-1; else echo $current_page; ?>">Previous</a></li>
	<?php for ($i = 1; $i <= $pages; $i++): ?>
	<li class="page-item"><a class="page-link" href="/index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	<?php endfor; ?>
	<?php 
		$next = isset($_GET['page']) ? intval($_GET['page'])+1 : 2;
		if ($next > $pages) $next = $pages;
	?>
	<li class="page-item"><a class="page-link" href="/index.php?page=
		<?php echo $next; ?>
	">Next</a></li>
</ul>